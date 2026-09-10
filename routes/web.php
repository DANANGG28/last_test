<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest routes (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/',         [LoginController::class, 'create'])->name('login');
    Route::post('/',        [LoginController::class, 'store']);
    Route::post('/login',   [LoginController::class, 'store']);

    Route::get('/register',  [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Authenticated routes (sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::post('/logout',   [LoginController::class, 'destroy'])->name('logout');
});
