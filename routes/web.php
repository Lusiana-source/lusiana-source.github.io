<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BuyNowController;

// Halaman Utama (Homepage)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


// Dashboard Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


// Manajemen Profil Pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Manajemen Produk di Admin (CRUD)
Route::resource('admin/products', ProductController::class);
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');


// Halaman Checkout - Wajib Login
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Halaman Beli sekarang
Route::post('/buy-now', [BuyNowController::class, 'buyNow'])->name('buy.now');
Route::get('/checkout/buy-now', [BuyNowController::class, 'showCheckout'])->name('checkout.buy-now');
Route::post('/checkout/buy-now', [BuyNowController::class, 'processCheckout'])->name('checkout.buy-now.process');

// Halaman Order
Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history')->middleware('auth');

Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');

// Include Routes untuk Autentikasi (Login, Register, dll.)
require __DIR__.'/auth.php';

