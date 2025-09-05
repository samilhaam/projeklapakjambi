<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        Story::create([
            'title' => 'Cerita UMKM Jambi',
            'slug' => 'cerita-umkm-jambi',
            'excerpt' => 'Perjalanan UMKM lokal menuju digitalisasi.',
            'content' => 'Ini adalah isi lengkap cerita UMKM yang penuh inspirasi...'
        ]);
    }
}
