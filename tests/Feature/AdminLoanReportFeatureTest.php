<?php

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('administrators can print a report containing only active loans', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $borrower = User::factory()->create([
        'name' => 'Peminjam Aktif',
        'nis' => '12345',
        'kelas' => 'XI A',
    ]);

    foreach (['borrowed', 'late', 'pending', 'returned', 'rejected'] as $status) {
        $book = Book::create([
            'title' => "Buku {$status}",
            'author' => 'Penulis',
        ]);

        Loan::create([
            'user_id' => $borrower->id,
            'book_id' => $book->id,
            'borrow_date' => today()->subDays(2),
            'due_date' => $status === 'late' ? today()->subDay() : today()->addDays(5),
            'status' => $status,
        ]);
    }

    $this->actingAs($admin)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee(route('admin.reports.active-loans'))
        ->assertSee('Cetak Rekap Peminjaman Sisa');

    $this->actingAs($admin)
        ->get(route('admin.reports.active-loans'))
        ->assertOk()
        ->assertSee('Rekap Peminjaman Sisa')
        ->assertSee('Peminjam Aktif')
        ->assertSee('12345')
        ->assertSee('Buku borrowed')
        ->assertSee('Buku late')
        ->assertSee('Terlambat')
        ->assertDontSee('Buku pending')
        ->assertDontSee('Buku returned')
        ->assertDontSee('Buku rejected')
        ->assertSee('2 peminjaman aktif');
});

test('non administrators cannot access the active loan report', function () {
    $this->actingAs(User::factory()->create(['role' => 'user']))
        ->get(route('admin.reports.active-loans'))
        ->assertForbidden();
});
