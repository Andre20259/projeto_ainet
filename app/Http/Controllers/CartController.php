<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Student;
use App\Http\Requests\CartConfirmationFormRequest;
use App\Models\Product;

class CartController extends Controller
{
    public function show(Request $request, Product $product): View
    {
        $cart = session('cart', null);
        return view('cart.show', compact('cart'));
    }
    // REceives the product and the quantity to add to the cart
    public function addToCart(Request $request, Product $product): RedirectResponse
    {
        $cart = session('cart', collect());
        $productId = $product->id;

        // Find if product is already in cart
        $existing = $cart->firstWhere('id', $productId);

        if ($existing) {
            // Increment quantity
            $existing->quantity = ($existing->quantity ?? 1) + 1;
            // Replace the product in the cart
            $cart = $cart->map(function ($item) use ($existing, $productId) {
                return $item->id === $productId ? $existing : $item;
            });
        } else {
            // Set initial quantity
            $product->quantity = 1;
            $cart->push($product);
        }

        $request->session()->put('cart', $cart);

        return back()->with('alert-msg', "Product added to cart.")->with('alert-type', 'success');
    }

    public function removeFromCart(Request $request, Product $product): RedirectResponse
    {
        $url = route('products.show', ['product' => $product]);
        $cart = session('cart', null);

        if (!$cart) {
            $alertType = 'warning';
            $htmlMessage = "Product <a href='$url'>#{$product->id}</a>
                <strong>\"{$product->name}\"</strong> was not removed from the cart
                because the cart is empty!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        } else {
            $element = $cart->firstWhere('id', $product->id);
            if ($element) {
                $cart->forget($cart->search($element));
                if ($cart->count() == 0) {
                    $request->session()->forget('cart');
                } else {
                    $request->session()->put('cart', $cart);
                }
                $alertType = 'success';
                $htmlMessage = "Product <a href='$url'>#{$product->id}</a>
                    <strong>\"{$product->name}\"</strong> was removed from the cart.";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            } else {
                $alertType = 'warning';
                $htmlMessage = "Product <a href='$url'>#{$product->id}</a>
                    <strong>\"{$product->name}\"</strong> was not removed from the cart
                    because the cart does not include it!";
                return back()
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', $alertType);
            }
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', 'Shopping Cart has been cleared');
    }


    // public function confirm(CartConfirmationFormRequest $request): RedirectResponse
    // {
    // }
}
