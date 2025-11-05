<?php

namespace Database\Seeders;

use App\Models\Extracurricular;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtracurricularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extracurriculars = [
            [
                'name' => 'Pramuka',
                'slug' => 'pramuka',
                'description' => '<p>Kegiatan kepramukaan untuk membentuk karakter dan jiwa kepemimpinan siswa.</p><p>Kegiatan dilaksanakan setiap hari Jumat pukul 14:00-16:00 WIB.</p>',
                'schedule' => 'Jumat, 14:00 - 16:00 WIB',
                'instructor_name' => 'Bapak Sugiarto, S.Pd',
            ],
            [
                'name' => 'Basket',
                'slug' => 'basket',
                'description' => '<p>Ekstrakurikuler basket untuk mengembangkan bakat olahraga siswa.</p><p>Tersedia untuk putra dan putri dengan pelatih berpengalaman.</p>',
                'schedule' => 'Selasa & Kamis, 15:00 - 17:00 WIB',
                'instructor_name' => 'Bapak Andi Saputra',
            ],
            [
                'name' => 'Paduan Suara',
                'slug' => 'paduan-suara',
                'description' => '<p>Mengasah kemampuan vokal dan harmoni dalam bernyanyi secara berkelompok.</p><p>Sering menjuarai berbagai kompetisi paduan suara tingkat kota dan provinsi.</p>',
                'schedule' => 'Rabu, 14:00 - 16:00 WIB',
                'instructor_name' => 'Ibu Siti Nurhaliza, S.Sn',
            ],
            [
                'name' => 'Robotika',
                'slug' => 'robotika',
                'description' => '<p>Belajar merancang dan memprogram robot untuk berbagai kompetisi.</p><p>Menggunakan platform Arduino dan Lego Mindstorms.</p>',
                'schedule' => 'Senin & Rabu, 15:00 - 17:00 WIB',
                'instructor_name' => 'Bapak Rahmat Hidayat, S.Kom',
            ],
            [
                'name' => 'Jurnalistik',
                'slug' => 'jurnalistik',
                'description' => '<p>Mengembangkan kemampuan menulis berita, feature, dan fotografi.</p><p>Membuat majalah sekolah dan mengelola media sosial sekolah.</p>',
                'schedule' => 'Kamis, 14:00 - 16:00 WIB',
                'instructor_name' => 'Ibu Dewi Lestari, S.Sos',
            ],
            [
                'name' => 'Seni Tari',
                'slug' => 'seni-tari',
                'description' => '<p>Mempelajari berbagai jenis tarian tradisional dan modern.</p><p>Sering tampil dalam acara-acara sekolah dan perlombaan.</p>',
                'schedule' => 'Jumat, 15:00 - 17:00 WIB',
                'instructor_name' => 'Ibu Maya Anggraini, S.Sn',
            ],
        ];

        foreach ($extracurriculars as $extracurricular) {
            Extracurricular::create($extracurricular);
        }
    }
}
