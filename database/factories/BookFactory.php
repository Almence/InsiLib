<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        $judulBuku = [
            'Laskar Pelangi',
            'Bumi Manusia',
            'Filosofi Teras',
            'Negeri 5 Menara',
            'Cantik Itu Luka',
            'Hujan di Bulan Juni',
            'Dilan 1990',
            'Bumi',
            'Komet',
            'Garis Waktu',
            'Arah Langkah',
            'Bicara Itu Ada Seninya',
            'Sebuah Seni untuk Bersikap Bodo Amat',
            'Laut Bercerita',
            'Rindu',
            'Pulang',
            'Selamat Tinggal',
            'Orang-Orang Biasa',
            'Anak Semua Bangsa',
            'Jejak Langkah',
            'Rumah Kaca',
            'Perahu Kertas',
            'Ronggeng Dukuh Paruk'
        ];

        // Kumpulan penerbit terkenal di Indonesia
        $penerbit = [
            'Gramedia Pustaka Utama',
            'Mizan',
            'Erlangga',
            'Republika',
            'Bentang Pustaka',
            'Penerbit Buku Kompas'
        ];

        $place = [
            'A1 - 1',
            'A1 - 2',
            'A1 - 3',
            'A1 - 4',
            'A2 - 1',
            'A2 - 2',
            'A2 - 3',
            'A2 - 4',
            'A3 - 1',
            'A3 - 2',
            'A3 - 3',
            'A3 - 4'
        ];

        $cover_image = [
            'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=600&fit=crop',
        ];

        return [
            // Mengambil judul acak + menambahkan variasi volume/edisi
            'title' => fake()->randomElement($judulBuku) . ' - Vol. ' . fake()->numberBetween(1, 5),

            // Nama pengarang khas Indonesia
            'author' => fake('id_ID')->name(),

            // Nama penerbit Indonesia
            'publisher' => fake()->randomElement($penerbit),

            // Tahun terbit
            'year' => fake()->numberBetween(2015, 2024),

            // Stok acak
            'stock' => fake()->numberBetween(5, 25),

            'cover_image' => fake()->randomElement($cover_image),

            'place' => fake()->randomElement($place),
        ];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (\App\Models\Book $book) {
            // Ambil 1 sampai 3 kategori secara acak dari database, lalu pasangkan ke buku ini
            $randomCategories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $book->categories()->attach($randomCategories);
        });
    }
}
