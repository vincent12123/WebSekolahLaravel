<?php

namespace Database\Seeders;

use App\Models\DownloadCategory;
use App\Models\DownloadFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Formulir'],
            ['name' => 'Materi Pembelajaran'],
            ['name' => 'Peraturan'],
            ['name' => 'Kalender Akademik'],
        ];

        foreach ($categories as $category) {
            $cat = DownloadCategory::create($category);

            // Add sample files for each category
            if ($cat->name === 'Formulir') {
                DownloadFile::create([
                    'download_category_id' => $cat->id,
                    'title' => 'Formulir Pendaftaran Siswa Baru',
                    'file_path' => 'downloads/formulir-psb.pdf',
                    'file_type' => 'PDF',
                    'file_size_kb' => 245,
                ]);
            } elseif ($cat->name === 'Materi Pembelajaran') {
                DownloadFile::create([
                    'download_category_id' => $cat->id,
                    'title' => 'Modul Matematika Kelas X',
                    'file_path' => 'downloads/modul-matematika-x.pdf',
                    'file_type' => 'PDF',
                    'file_size_kb' => 3276,
                ]);
            } elseif ($cat->name === 'Peraturan') {
                DownloadFile::create([
                    'download_category_id' => $cat->id,
                    'title' => 'Tata Tertib Sekolah',
                    'file_path' => 'downloads/tata-tertib.pdf',
                    'file_type' => 'PDF',
                    'file_size_kb' => 184,
                ]);
            } elseif ($cat->name === 'Kalender Akademik') {
                DownloadFile::create([
                    'download_category_id' => $cat->id,
                    'title' => 'Kalender Akademik 2025/2026',
                    'file_path' => 'downloads/kalender-akademik-2025-2026.pdf',
                    'file_type' => 'PDF',
                    'file_size_kb' => 532,
                ]);
            }
        }
    }
}
