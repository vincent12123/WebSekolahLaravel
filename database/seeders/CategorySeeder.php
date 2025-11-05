<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Berita Sekolah',
                'slug' => 'berita-sekolah',
            ],
            [
                'name' => 'Prestasi',
                'slug' => 'prestasi',
            ],
            [
                'name' => 'Kegiatan',
                'slug' => 'kegiatan',
            ],
            [
                'name' => 'Akademik',
                'slug' => 'akademik',
            ],
            [
                'name' => 'Ekstrakurikuler',
                'slug' => 'ekstrakurikuler',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
