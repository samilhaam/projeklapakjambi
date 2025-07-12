<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Sepatu Lokal Jambi',
            'slug' => 'sepatu-lokal-jambi',
            'cover' => 'cover.jpg',
            'price' => 150000,
            'about' => 'Produk sepatu asli UMKM Jambi',
            'path_file' => 'produk/cover.jpg',
            'category_id' => 1,
            'creator_id' => 1
        ]);
    }
}
