<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = (int) $request->input('per_page', 10);
        $loans = auth()->user()->loans()->with('book')->paginate($perPage);

        if (auth()->user()->role = 'admin') {
            $pendingLoans = Loan::with(['user', 'book'])->where('status', 'pending')->latest()->get();
            $borrowedLoans = Loan::with(['user', 'book'])->where('status', 'borrowed')->latest()->get();
            return view('dashboard', compact('borrowedLoans', 'pendingLoans'));
        }

        return view('dashboard', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
