<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/catalog', [BookController::class, 'index'])->name('catalog');
    Route::get('/dashboard', )->name('dashboard');
    Route::get('/profile', )->name('profile');
    Route::resource('books', BookController::class)->only(['index', 'show']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
