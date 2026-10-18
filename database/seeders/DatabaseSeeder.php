<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Alex',
            'email' => 'alex@perpustakaan.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $this->call([
            CategorySeeder::class,
        ]);

        Book::factory(50)->create()->each(function ($book) {
            $categoryIds = Category::inRandomOrder()->take(rand(1, 2))->pluck('id');

            $book->categories()->attach($categoryIds);
        });
    }
}
