<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $events = [
            [
                'title' => 'Masa Pengenalan Lingkungan Sekolah (MPLS) 2025',
                'description' => 'Kegiatan orientasi untuk peserta didik baru guna mengenal lingkungan sekolah, guru, dan budaya sekolah.',
                'starts_at' => $now->copy()->addDays(10)->setTime(8, 0),
                'ends_at' => $now->copy()->addDays(10)->setTime(11, 0),
                'location' => 'Aula Utama',
                'image_url' => null,
                'status' => 'scheduled',
                'published_at' => $now->copy(),
            ],
            [
                'title' => 'Rapat Orang Tua/Wali Semester Ganjil 2025',
                'description' => 'Rapat koordinasi bersama orang tua/wali untuk membahas program semester, tata tertib, dan evaluasi pembelajaran.',
                'starts_at' => $now->copy()->addDays(20)->setTime(9, 0),
                'ends_at' => $now->copy()->addDays(20)->setTime(12, 0),
                'location' => 'Gedung Serbaguna',
                'image_url' => null,
                'status' => 'scheduled',
                'published_at' => $now->copy()->subDay(),
            ],
            [
                'title' => 'Lomba Kebersihan Kelas',
                'description' => 'Penilaian kebersihan dan kerapian kelas untuk menumbuhkan budaya bersih dan sehat di lingkungan sekolah.',
                'starts_at' => $now->copy()->subDays(25)->setTime(7, 30),
                'ends_at' => $now->copy()->subDays(25)->setTime(10, 0),
                'location' => 'Seluruh Kelas',
                'image_url' => null,
                'status' => 'completed',
                'published_at' => $now->copy()->subDays(30),
            ],
            [
                'title' => 'Workshop Keterampilan Digital Guru',
                'description' => 'Pelatihan penggunaan perangkat dan aplikasi digital untuk mendukung proses pembelajaran.',
                'starts_at' => $now->copy()->addDays(5)->setTime(13, 0),
                'ends_at' => $now->copy()->addDays(5)->setTime(16, 30),
                'location' => 'Lab Komputer',
                'image_url' => null,
                'status' => 'cancelled',
                'published_at' => $now->copy()->subDays(2),
            ],
            [
                'title' => 'Upacara Bendera Peringatan Hari Pahlawan',
                'description' => 'Upacara bendera untuk memperingati Hari Pahlawan dan meneladani nilai-nilai kepahlawanan.',
                'starts_at' => Carbon::parse(date('Y') . '-11-10 07:00:00'),
                'ends_at' => Carbon::parse(date('Y') . '-11-10 08:00:00'),
                'location' => 'Lapangan Sekolah',
                'image_url' => null,
                'status' => Carbon::now()->greaterThan(Carbon::parse(date('Y') . '-11-10 08:00:00')) ? 'completed' : 'scheduled',
                'published_at' => $now->copy()->subDays(1),
            ],
        ];

        foreach ($events as $data) {
            $slug = Str::slug($data['title']);

            Event::updateOrCreate(
                ['slug' => $slug],
                array_merge($data, ['slug' => $slug])
            );
        }
    }
}
