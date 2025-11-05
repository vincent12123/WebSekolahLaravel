<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Penerimaan Siswa Baru Tahun Ajaran 2025/2026',
                'content' => '<p>Dengan hormat, kami mengumumkan bahwa pendaftaran siswa baru untuk tahun ajaran 2025/2026 akan dibuka mulai tanggal <strong>1 Desember 2025</strong>.</p><p>Informasi lengkap dapat dilihat di website sekolah atau menghubungi panitia PSB.</p>',
                'is_important' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Libur Semester Ganjil',
                'content' => '<p>Libur semester ganjil akan dimulai pada tanggal <strong>20 Desember 2025</strong> sampai dengan <strong>5 Januari 2026</strong>.</p><p>Masuk kembali tanggal 6 Januari 2026.</p>',
                'is_important' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Ujian Tengah Semester',
                'content' => '<p>Ujian Tengah Semester akan dilaksanakan pada tanggal <strong>15-22 November 2025</strong>.</p><p>Harap siswa mempersiapkan diri dengan baik.</p>',
                'is_important' => false,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Rapat Orang Tua Siswa',
                'content' => '<p>Akan diadakan rapat orang tua siswa pada tanggal <strong>30 November 2025</strong> pukul 09:00 WIB di Aula Sekolah.</p><p>Kehadiran orang tua sangat diharapkan.</p>',
                'is_important' => false,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Peringatan Hari Pahlawan',
                'content' => '<p>Dalam rangka memperingati Hari Pahlawan, akan diadakan upacara bendera pada tanggal <strong>10 November 2025</strong>.</p><p>Seluruh siswa wajib mengikuti upacara dengan mengenakan seragam lengkap.</p>',
                'is_important' => false,
                'published_at' => now()->subHours(12),
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
