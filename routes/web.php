<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;


// Home
Route::get('/', [ShopController::class, 'home']);

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Cart Routes
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/update', [CartController::class, 'update']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']);

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/order/place', [CheckoutController::class, 'placeOrder']);

// Product Detail
Route::get('/product/{id}', [ShopController::class, 'show']);

// User Pages
Route::get('/profile', function () {
    return view('user.profile');
});

Route::get('/wishlist', function () {
    return view('user.wishlist');
});

Route::get('/orders', function () {
    return view('user.orders');
});