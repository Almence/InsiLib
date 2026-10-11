<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

uses(RefreshDatabase::class);

function createCatalogTestCategory(): int
{
    return DB::table('categories')->insertGetId([
        'name' => 'Test Category',
        'slug' => 'test-category',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

test('catalog search matches titles and authors', function () {
    /** @var TestCase $testCase */
    $testCase = $this;
    $testCase->actingAs(User::factory()->create());
    $categoryId = createCatalogTestCategory();

    Book::create([
        'category_id' => $categoryId,
        'title' => 'The Hobbit',
        'author' => 'J. R. R. Tolkien',
    ]);
    Book::create([
        'category_id' => $categoryId,
        'title' => 'Dune',
        'author' => 'Frank Herbert',
    ]);

    $testCase->get(route('dashboard', ['search' => 'Tolkien']))
        ->assertOk()
        ->assertViewHas('books', fn ($books) => $books->total() === 1)
        ->assertSee('The Hobbit')
        ->assertDontSee('Dune');
});

test('catalog uses the selected page size', function () {
    /** @var TestCase $testCase */
    $testCase = $this;
    $testCase->actingAs(User::factory()->create());
    $categoryId = createCatalogTestCategory();

    foreach (range(1, 21) as $number) {
        Book::create([
            'category_id' => $categoryId,
            'title' => "Book {$number}",
            'author' => 'Test Author',
        ]);
    }

    $testCase->get(route('dashboard', ['per_page' => 10]))
        ->assertOk()
        ->assertViewHas('books', fn ($books) => $books->perPage() === 10 && $books->total() === 21);
});
