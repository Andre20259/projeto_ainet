<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\EmployeeFormRequest;

class UserController extends Controller
{
    use \App\Traits\UserPhotoFileStorage;
    
    public function index(Request $request): View
    {
        
        
        $usersQuery = User::orderBy('type')->orderBy('name');

        $filterByName = $request->query('name');
        if ($filterByName) {
            $usersQuery->where('name', 'like', "%$filterByName%");
        }

        $filterByType = $request->query('type');
        if ($filterByType) {
            $usersQuery->where('type', 'like', "%$filterByType%");
        }

        $allUsers = $usersQuery->paginate(20)->withQueryString();

        return view(
            'users.index',
            compact('allUsers', 'filterByName', 'filterByType')
        );
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);;
    }
    public function edit(User $user): View
    {
        return view('users.edit') ->with('user', $user);
    }

    public function update(UserFormRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();

        // Atualiza os campos do user
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->gender = $validatedData['gender'];
        $user->nif = $validatedData['nif'] ?? null;
        $user->default_delivery_address = $validatedData['default_delivery_address'] ?? null;
        $user->default_payment_type = $validatedData['default_payment_type'] ?? null;
        $user->default_payment_reference = $validatedData['default_payment_reference'] ?? null;

    //     // Se quiser permitir upload de foto:
    // if ($request->hasFile('photo_file')) {
    //     // Apaga a foto antiga se existir
    //     if ($user->photo) {
    //         \Storage::disk('public')->delete($user->photo);
    //     }
    //     $user->photo = $request->file('photo_file')->store('photos', 'public');
    // }

        $user->save();
        return redirect()->route('users.show', ['user' => $user])
            ->with('alert-type', 'success')
            ->with('alert-msg', "User <u>{$user->name}</u> updated successfully!");
    }

    public function create(): View
    {
        $newEmployee = new User();
        $newEmployee->type = 'employee';
        return view('users.create')
            ->with('user', $newEmployee);
    }

    public function store(EmployeeFormRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $newEmployee = new User();
        $newEmployee->type = 'employee';
        $newEmployee->name = $validatedData['name'];
        $newEmployee->email = $validatedData['email'];
        $newEmployee->gender = $validatedData['gender'];
        // Initial password is always 123
        $newEmployee->password = bcrypt('123');
        $newEmployee->save();
        // File store is the last thing to execute!
        // Files do not rollback, so the probability of having a pending file 
        // (not referenced by any user) is reduced by being the last operation
        $this->storeUserPhoto($request->photo_file, $newEmployee);        
        $url = route('users.show', ['user' => $newEmployee]);
        $htmlMessage = "Employee <a href='$url'><u>{$newEmployee->name}</u></a> has been created successfully!";
        return redirect()->route('users.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }
}