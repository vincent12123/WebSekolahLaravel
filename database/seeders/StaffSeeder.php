<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = [
            [
                'name' => 'Dr. Ahmad Fauzi, M.Pd',
                'position' => 'Kepala Sekolah',
                'email' => 'kepala.sekolah@example.com',
                'bio' => 'Kepala Sekolah dengan pengalaman 15 tahun di bidang pendidikan. Memimpin sekolah dengan dedikasi tinggi untuk meningkatkan kualitas pendidikan.',
                'display_order' => 1,
            ],
            [
                'name' => 'Dra. Siti Nurhaliza, M.Pd',
                'position' => 'Wakil Kepala Sekolah Kurikulum',
                'email' => 'waka.kurikulum@example.com',
                'bio' => 'Mengelola dan mengembangkan kurikulum sekolah sesuai dengan perkembangan zaman dan kebutuhan siswa.',
                'display_order' => 2,
            ],
            [
                'name' => 'Bapak Rahmat Hidayat, S.Pd',
                'position' => 'Wakil Kepala Sekolah Kesiswaan',
                'email' => 'waka.kesiswaan@example.com',
                'bio' => 'Membina dan mengembangkan potensi siswa melalui berbagai kegiatan ekstrakurikuler dan pembinaan karakter.',
                'display_order' => 3,
            ],
            [
                'name' => 'Ibu Dewi Lestari, S.E',
                'position' => 'Kepala Tata Usaha',
                'email' => 'tata.usaha@example.com',
                'bio' => 'Mengelola administrasi dan keuangan sekolah dengan profesional dan transparan.',
                'display_order' => 4,
            ],
            [
                'name' => 'Bapak Andi Saputra, S.Pd',
                'position' => 'Guru Matematika',
                'email' => 'andi.saputra@example.com',
                'bio' => 'Guru Matematika dengan spesialisasi Olimpiade. Telah membimbing banyak siswa meraih prestasi di berbagai kompetisi.',
                'display_order' => 5,
            ],
            [
                'name' => 'Ibu Maya Anggraini, S.Pd',
                'position' => 'Guru Bahasa Inggris',
                'email' => 'maya.anggraini@example.com',
                'bio' => 'Guru Bahasa Inggris bersertifikat TOEFL 600. Berpengalaman mengajar dengan metode yang interaktif dan menyenangkan.',
                'display_order' => 6,
            ],
            [
                'name' => 'Bapak Sugiarto, S.Pd',
                'position' => 'Guru Fisika',
                'email' => 'sugiarto@example.com',
                'bio' => 'Guru Fisika dengan pengalaman 10 tahun. Mampu menjelaskan konsep fisika dengan mudah dipahami siswa.',
                'display_order' => 7,
            ],
            [
                'name' => 'Ibu Sri Rahayu, S.Kom',
                'position' => 'Guru TIK',
                'email' => 'sri.rahayu@example.com',
                'bio' => 'Guru TIK yang menguasai berbagai bahasa pemrograman dan teknologi terkini untuk pembelajaran siswa.',
                'display_order' => 8,
            ],
        ];

        foreach ($staff as $person) {
            Staff::create($person);
        }
    }
}
