<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\LoanApiController;

// Rute Publik (Bisa diakses tanpa login)
Route::post('/login', [AuthController::class, 'login']);
Route::get('/books', [BookApiController::class, 'index']);

// Rute Privat (Wajib membawa Token Sanctum / Harus Login di HP)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Endpoint saat QR discan dari HP
    Route::post('/borrow/request', [LoanApiController::class, 'storeRequest']);
    
    // Endpoint Dashboard Member (Riwayat & Kode 4-Digit)
    Route::get('/my-loans', [LoanApiController::class, 'myLoans']);
});
