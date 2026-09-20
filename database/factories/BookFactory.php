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
            'Laskar Pelangi', 'Bumi Manusia', 'Filosofi Teras', 'Negeri 5 Menara',
            'Cantik Itu Luka', 'Hujan di Bulan Juni', 'Dilan 1990', 'Bumi',
            'Komet', 'Garis Waktu', 'Arah Langkah', 'Bicara Itu Ada Seninya',
            'Sebuah Seni untuk Bersikap Bodo Amat', 'Laut Bercerita', 'Rindu',
            'Pulang', 'Selamat Tinggal', 'Orang-Orang Biasa', 'Anak Semua Bangsa',
            'Jejak Langkah', 'Rumah Kaca', 'Perahu Kertas', 'Ronggeng Dukuh Paruk'
        ];

        // Kumpulan penerbit terkenal di Indonesia
        $penerbit = [
            'Gramedia Pustaka Utama', 'Mizan', 'Erlangga', 
            'Republika', 'Bentang Pustaka', 'Penerbit Buku Kompas'
        ];

        return [
            // Mengambil ID kategori acak
            'category_id' => Category::inRandomOrder()->first()->id,
            
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
            
            // Gambar sampul buku otomatis (Resolusi 400x600 piksel)
            'cover_image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/400/600',
        ];
    }
}
