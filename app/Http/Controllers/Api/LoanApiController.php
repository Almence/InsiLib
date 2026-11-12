<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanApiController extends Controller
{
    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $user = $request->user();

        $loanCreated = DB::transaction(function () use ($user, $validated) {
            $user = $user->newQuery()->lockForUpdate()->findOrFail($user->id);
            $activeLoansCount = $user->loans()->whereIn('status', ['pending', 'borrowed', 'late'])->count();

            if ($activeLoansCount >= 2) {
                return false;
            }

            $user->loans()->create([
                'book_id' => $validated['book_id'],
                'borrow_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(7),
                'status' => 'pending',
                'verification_code' => rand(1000, 9999),
                'fine' => 0,
            ]);

            return true;
        });

        if (! $loanCreated) {
            return response()->json([
                'success' => false,
                'message' => 'Batas maksimal tercapai! Kamu sedang memiliki 2 buku aktif.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Permintaan peminjaman berhasil! Tunjukkan kode verifikasi ke petugas.',
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
