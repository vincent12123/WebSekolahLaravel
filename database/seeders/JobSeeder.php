<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'position' => 'Guru Matematika',
                'description' => '<p>Sekolah kami membuka lowongan untuk posisi Guru Matematika SMA.</p><h3>Kualifikasi:</h3><ul><li>Pendidikan minimal S1 Pendidikan Matematika</li><li>Memiliki pengalaman mengajar minimal 2 tahun</li><li>Menguasai kurikulum terbaru</li><li>Mampu menggunakan teknologi dalam pembelajaran</li></ul><h3>Tugas:</h3><ul><li>Mengajar mata pelajaran Matematika</li><li>Membuat RPP dan bahan ajar</li><li>Melakukan evaluasi pembelajaran</li></ul>',
                'requirements' => 'S1 Pendidikan Matematika, Pengalaman 2 tahun, Menguasai kurikulum',
                'job_type' => 'Penuh Waktu',
                'location' => 'Jakarta',
                'deadline' => now()->addMonth(),
                'status' => 'open',
            ],
            [
                'position' => 'Guru Bahasa Inggris',
                'description' => '<p>Dibutuhkan Guru Bahasa Inggris yang berpengalaman dan berkompeten.</p><h3>Kualifikasi:</h3><ul><li>Pendidikan minimal S1 Pendidikan Bahasa Inggris atau Sastra Inggris</li><li>Memiliki sertifikat TOEFL minimal 550</li><li>Pengalaman mengajar minimal 1 tahun</li><li>Komunikatif dan kreatif dalam mengajar</li></ul>',
                'requirements' => 'S1 Bahasa Inggris, TOEFL 550, Pengalaman 1 tahun',
                'job_type' => 'Penuh Waktu',
                'location' => 'Jakarta',
                'deadline' => now()->addMonth(),
                'status' => 'open',
            ],
            [
                'position' => 'Staff Administrasi',
                'description' => '<p>Membuka lowongan untuk Staff Administrasi sekolah.</p><h3>Kualifikasi:</h3><ul><li>Pendidikan minimal D3 semua jurusan</li><li>Menguasai Microsoft Office</li><li>Teliti dan bertanggung jawab</li><li>Mampu bekerja dalam tim</li></ul><h3>Tugas:</h3><ul><li>Mengelola administrasi sekolah</li><li>Membuat laporan</li><li>Mengarsipkan dokumen</li></ul>',
                'requirements' => 'D3 semua jurusan, Menguasai MS Office, Teliti',
                'job_type' => 'Penuh Waktu',
                'location' => 'Jakarta',
                'deadline' => now()->addMonth(),
                'status' => 'open',
            ],
            [
                'position' => 'Guru Olahraga (Kontrak)',
                'description' => '<p>Dibutuhkan Guru Olahraga dengan sistem kontrak 1 tahun.</p><h3>Kualifikasi:</h3><ul><li>Pendidikan minimal S1 Pendidikan Jasmani</li><li>Memiliki pengalaman melatih olahraga</li><li>Sehat jasmani dan rohani</li><li>Mampu membimbing ekstrakurikuler olahraga</li></ul>',
                'requirements' => 'S1 Pendidikan Jasmani, Pengalaman melatih, Sehat jasmani',
                'job_type' => 'Kontrak',
                'location' => 'Jakarta',
                'deadline' => now()->addWeeks(3),
                'status' => 'open',
            ],
        ];

        foreach ($jobs as $job) {
            JobListing::create($job);
        }
    }
}
