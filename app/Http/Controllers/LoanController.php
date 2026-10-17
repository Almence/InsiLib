<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function showConfirmBorrow($id)
    {
        $book = Book::findOrFail($id);
        return view('confirm-request', compact('book'));
    }
    public function requestBorrow($id)
    {
        $book = Book::findOrFail($id);

        $activeLoansCount = auth()->user()->loans()->whereIn('status', ['pending', 'borrowed'])->count();

        if ($activeLoansCount >= 2) {
            return redirect()->route('dashboard')->with('error', 'Kamu sudah mencapai batas maksimum peminjaman! (2 Buku sedang aktif diajukan atau dipinjam).');
        }

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'pending',
            'verification_code' => rand(1000, 9999),
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan peminjaman buku berhasil! Silakan datangi perpustakaan dan tunjukkan kode verifikasi.');
    }

    public function approveLoan(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        // Validasi input kode 4 digit dari admin
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        // Pengecekan apakah kode cocok
        if ($request->verification_code != $loan->verification_code) {
            return back()->with('error', 'Kode verifikasi tidak cocok!');
        }

        // Update status peminjaman menjadi borrowed
        $loan->update([
            'status' => 'borrowed',
            'verification_code' => null, // Reset kode setelah diverifikasi
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        // CATATAN: Di tahap ini, stok buku akan otomatis berkurang 1 
        // jika kita memicu event pengurangan stok atau menjalankannya di sini:
        $loan->book->decrement('stock');

        return back()->with('success', 'Peminjaman berhasil diverifikasi! Stok buku telah berkurang.');
    }

    public function bookReturn($id)
    {
        $loan = Loan::findOrFail($id);

        $fine = 0;

        // Cek apakah tanggal hari ini melebihi tenggat waktu (due_date)
        if (now()->gt($loan->due_date)) {
            // Hitung selisih hari keterlambatan
            $daysLate = now()->startOfDay()->diffInDays($loan->due_date->startOfDay());

            // Hitung denda (misal: Rp 1.000 per hari terlambat)
            $fine = $daysLate * 1000;
        }

        // Update data peminjaman
        $loan->update([
            'status' => 'returned',
            'return_date' => now(), // Mencatat kapan buku benar-benar dikembalikan
            'fine' => $fine,        // Menyimpan total denda
        ]);

        // Kembalikan stok buku bertambah 1
        $loan->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan! Total denda: Rp ' . number_format($fine, 0, ',', '.'));
    }
}
