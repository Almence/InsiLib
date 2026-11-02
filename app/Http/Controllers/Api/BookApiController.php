<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookApiController extends Controller
{
    public function index()
    {
        $book = Book::with('categories')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Katalog Buku InsiLib',
            'data' => $book
        ], 200);
    }
}
