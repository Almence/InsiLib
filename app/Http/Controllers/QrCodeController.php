<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View;
use Illuminate\Http\Request;
use Laravel\Mcp\Enums\Role;

class QrCodeController extends Controller
{
    public function printQr()
    {
        if (auth()->user()->role !== 'admin'){
            abort(403, 'Anda tidak memiliki akses untuk membuka halaman ini!');
        }

        $books = Book::latest()->get();

        return view('admin.print-qr', compact('books'));
    }
}
