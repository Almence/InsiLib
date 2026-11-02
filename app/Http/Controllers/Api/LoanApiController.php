<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Carbon\Carbon;
use function PHPUnit\Framework\returnArgument;

class LoanApiController extends Controller
{
    public function storeRequest(Request $request)
    {
        $request->validate([
            'book_id' => 'requeured|exist:books.id',
        ]);

        $user = $request->user();

        $activeLoansCount = Loan::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'borrowed'])
        ->count();

        if ($activeLoansCount >= 2) {
            return response()->json([
                'success' => false,
                'message' => 'Batas maksimal tercapai! Kamu sedang memiliki 2 buku aktif.'
            ], 422);
        }

        $verificationCode = rand(1000, 9999);

        $loan = Loan::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id,
            'borrow_date' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(7),
            'verification_code' => $verificationCode,
            'fine' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan peminjaman berhasil! Tunjukkan kode verifikasi ke petugas.'
        ]);
    }

    public function myLoans(Request $request)
    {
        $user = $request->user();

        $loans = Loan::with('book')
        ->where('user_id', $user->id)
        ->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data riwayat peminjaman',
            'data' => $loans
        ], 200);
    }
}
