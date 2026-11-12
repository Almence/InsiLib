<?php

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user cannot create more than two active loans through the web', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create();

    Loan::create([
        'user_id' => $user->id,
        'book_id' => $book->id,
        'borrow_date' => now(),
        'due_date' => now()->addDays(7),
        'status' => 'pending',
    ]);
    Loan::create([
        'user_id' => $user->id,
        'book_id' => $book->id,
        'borrow_date' => now(),
        'due_date' => now()->addDays(7),
        'status' => 'borrowed',
    ]);

    $this->actingAs($user)
        ->post(route('borrow.store', $book))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error');

    expect($user->loans()->whereIn('status', ['pending', 'borrowed', 'late'])->count())->toBe(2);
});

test('a user cannot create more than two active loans through the api', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create();

    foreach (['pending', 'late'] as $status) {
        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => $status,
        ]);
    }

    $this->actingAs($user, 'sanctum');

    $this->postJson('/api/borrow/request', ['book_id' => $book->id])
        ->assertUnprocessable()
        ->assertJsonPath('success', false)
        ->assertJsonPath('message', 'Batas maksimal tercapai! Kamu sedang memiliki 2 buku aktif.');

    expect($user->loans()->whereIn('status', ['pending', 'borrowed', 'late'])->count())->toBe(2);
});

test('api accepts a valid book id when the user has fewer than two active loans', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create();

    $this->actingAs($user, 'sanctum');

    $this->postJson('/api/borrow/request', ['book_id' => $book->id])
        ->assertOk()
        ->assertJsonPath('success', true);

    expect($user->loans()->whereIn('status', ['pending', 'borrowed'])->count())->toBe(1);
});

test('api rejects a book id that does not exist', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'sanctum');

    $this->postJson('/api/borrow/request', ['book_id' => 999])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('book_id');
});
