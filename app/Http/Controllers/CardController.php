<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoadCardRequest;
use App\Models\Card;
use App\Services\Payment;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    public function show()
    {
        $card = Card::with('operations')->findOrFail(auth()->id());

        return view('card.show', compact('card'));
    }

    public function showLoadForm()
    {
        // $card = Card::with('user')->where('id', auth()->id())->firstOrFail();
        $card = Card::with('user')->findOrFail(auth()->id());
        return view('card.load', compact('card'));
    }


    public function processLoad(LoadCardRequest $request)
    {
        $user = auth()->user();
        $card = $user->card;

        $method = $request->input('method');
        $amount = $request->input('amount');
        $valid = false;

        switch ($method) {
            case 'visa':
                $valid = Payment::payWithVisa($request->card_number, $request->cvc);
                break;
            case 'paypal':
                $valid = Payment::payWithPaypal($request->paypal_email);
                break;
            case 'mbway':
                $valid = Payment::payWithMBway($request->mbway_phone);
                break;
        }

        if (!$valid) {
            return back()->withErrors(['invalid' => 'Invalid payment details.']);
        }

        // $card = Card::firstOrCreate(
        //     ['user_id' => Auth::id()],
        //     ['card_number' => $this->generateCardNumber(), 'balance' => 0]
        // );

        $card->balance += $request->amount;
        $card->save();

        return redirect()->route('card.show')->with('success', 'Card load successfully!');
    }

    // private function generateCardNumber(): string
    // {
    //     do {
    //         $number = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    //     } while (Card::where('card_number', $number)->exists());

    //     return $number;
    // }
}
