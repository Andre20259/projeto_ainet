<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

// Add a discipline to the cart:
Route::post('cart/{discipline}', [CartController::class, 'addToCart'])->name('cart.add');

// Remove a discipline from the cart:
Route::delete('cart/{discipline}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Confirm (store) the cart and save disciplines registration on the database:
Route::post('cart', [CartController::class, 'confirm'])->name('cart.confirm');

// Clear the cart:
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

require __DIR__.'/auth.php';
