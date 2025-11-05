<?php

namespace Database\Seeders;

use App\Models\GalleryAlbum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Upacara Hari Kemerdekaan 2025',
                'slug' => 'upacara-hari-kemerdekaan-2025',
                'description' => 'Dokumentasi upacara peringatan hari kemerdekaan Indonesia ke-80',
                'event_date' => now()->subMonths(3),
            ],
            [
                'title' => 'Pentas Seni Sekolah 2025',
                'slug' => 'pentas-seni-sekolah-2025',
                'description' => 'Penampilan seni dari berbagai ekstrakurikuler sekolah',
                'event_date' => now()->subMonths(2),
            ],
            [
                'title' => 'Kunjungan Industri ke Pabrik',
                'slug' => 'kunjungan-industri-ke-pabrik',
                'description' => 'Siswa kelas XII melakukan kunjungan industri untuk pembelajaran praktis',
                'event_date' => now()->subMonth(),
            ],
            [
                'title' => 'Kompetisi Olahraga Antar Kelas',
                'slug' => 'kompetisi-olahraga-antar-kelas',
                'description' => 'Turnamen olahraga antar kelas dalam rangka mempererat persaudaraan',
                'event_date' => now()->subWeeks(2),
            ],
            [
                'title' => 'Kegiatan Bakti Sosial',
                'slug' => 'kegiatan-bakti-sosial',
                'description' => 'Siswa melakukan bakti sosial ke panti asuhan',
                'event_date' => now()->subWeek(),
            ],
        ];

        foreach ($albums as $album) {
            GalleryAlbum::create($album);
        }
    }
}
