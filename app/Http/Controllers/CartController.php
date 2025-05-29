<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Discipline;
use App\Models\Student;
use App\Http\Requests\CartConfirmationFormRequest;
use App\Models\Product;

class CartController extends Controller
{
    public function show(): View
    {
        // Inicial value of $cart is just for testing. Later, $cart should have the list of disciplines on the cart
        $cart = Product::where('category_id', '2')->get();
        return view('cart.show', compact('cart'));
    }

    public function addToCart(Request $request, Discipline $discipline): RedirectResponse
    {
    }

    public function removeFromCart(Request $request, Discipline $discipline): RedirectResponse
    {
    }

    public function destroy(Request $request): RedirectResponse
    {
    }


    public function confirm(CartConfirmationFormRequest $request): RedirectResponse
    {
    }
}
