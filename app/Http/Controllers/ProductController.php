<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Categorie;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request): View
    {
        $categories = Categorie::all();
        $name = $request->name;
        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('name') ) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $products = $query->paginate(18)->withQueryString();

        // Pass the current name value to the view
        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'name' => $request->name,
        ]);
    }
    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('products.create');
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


}

