<?php

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

test('catalog search matches titles and authors', function () {
    /** @var TestCase $testCase */
    $testCase = $this;
    $testCase->actingAs(User::factory()->create());

    Book::create([
        'title' => 'The Hobbit',
        'author' => 'J. R. R. Tolkien',
    ]);
    Book::create([
        'title' => 'Dune',
        'author' => 'Frank Herbert',
    ]);

    $testCase->get(route('catalog', ['search' => 'Tolkien']))
        ->assertOk()
        ->assertViewHas('books', fn ($books) => $books->total() === 1)
        ->assertSee('The Hobbit')
        ->assertDontSee('Dune');
});

test('catalog filters books by category through the pivot table', function () {
    /** @var TestCase $testCase */
    $testCase = $this;
    $testCase->actingAs(User::factory()->create());

    $fiction = Category::create([
        'name' => 'Fiction',
        'slug' => 'fiction',
    ]);
    $science = Category::create([
        'name' => 'Science',
        'slug' => 'science',
    ]);

    $fictionBook = Book::create([
        'title' => 'The Fiction Book',
        'author' => 'Test Author',
    ]);
    $scienceBook = Book::create([
        'title' => 'The Science Book',
        'author' => 'Test Author',
    ]);

    $fictionBook->categories()->attach($fiction);
    $scienceBook->categories()->attach($science);

    $testCase->get(route('catalog', ['filter_by' => $fiction->id]))
        ->assertOk()
        ->assertViewHas('books', fn ($books) => $books->total() === 1)
        ->assertSee('The Fiction Book')
        ->assertDontSee('The Science Book');
});

test('catalog uses the selected page size', function () {
    /** @var TestCase $testCase */
    $testCase = $this;
    $testCase->actingAs(User::factory()->create());

    foreach (range(1, 21) as $number) {
        Book::create([
            'title' => "Book {$number}",
            'author' => 'Test Author',
        ]);
    }

    $testCase->get(route('catalog', ['per_page' => 10]))
        ->assertOk()
        ->assertViewHas('books', fn ($books) => $books->perPage() === 10 && $books->total() === 21);
});
