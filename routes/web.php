<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/catalog', [BookController::class, 'index'])->name('catalog');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', )->name('profile');
    Route::get('/request-borrow/{id}', [LoanController::class, 'showConfirmBorrow'])->name('borrow.confirm');
    Route::post('/request-borrow/{id}', [LoanController::class, 'requestBorrow'])->name('borrow.store');
    Route::post('/admin/loans/{id}/approve', [LoanController::class, 'approveLoan'])->name('admin.loans.approve');
    Route::post('/admin/loans/{id}/return', [LoanController::class, 'bookReturn'])->name('admin.loans.return');
    Route::get('/admin/print-qr', [QrCodeController::class, 'printQr'])->name('admin.print-qr');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/admin/books/update/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/admin/books/create', [BookController::class, 'store'])->name('books.store');
    Route::post('/admin/books/update/{id}', [BookController::class, 'update'])->name('books.update');
    Route::resource('books', BookController::class)->only(['index', 'show']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
