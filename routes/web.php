<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Halaman utama (tanpa autentikasi)
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/payment', [PaymentController::class, 'checkout'])->name('payment');

// Autentikasi (Login & Logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {

    // Kelola produk di admin
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/dashboard', [AdminController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
        Route::post('/products/{id}', [AdminController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');
    });

    // Home route setelah login (Laravel UI)
    Route::get('/home', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Default route dari Laravel UI (untuk fitur login, register, reset password)
Auth::routes();
