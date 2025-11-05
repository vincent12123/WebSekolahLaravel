<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();
        $categories = Category::all();

        $articles = [
            [
                'title' => 'Siswa Berprestasi Meraih Juara 1 Olimpiade Matematika',
                'slug' => 'siswa-berprestasi-meraih-juara-1-olimpiade-matematika',
                'content' => '<p>Kami dengan bangga mengumumkan bahwa siswa kami, <strong>Ahmad Fauzi</strong> dari kelas XII IPA 1, berhasil meraih juara 1 dalam Olimpiade Matematika tingkat provinsi.</p><p>Prestasi ini merupakan hasil kerja keras dan dedikasi Ahmad dalam belajar matematika. Kami berharap prestasi ini dapat memotivasi siswa lain untuk terus berprestasi.</p><p>Selamat kepada Ahmad Fauzi dan pembimbing yang telah mendukung perjalanan ini!</p>',
                'excerpt' => 'Siswa kelas XII IPA 1 meraih juara 1 Olimpiade Matematika tingkat provinsi',
                'category_id' => $categories->where('slug', 'prestasi')->first()->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Pelaksanaan Kegiatan Study Tour ke Museum Nasional',
                'slug' => 'pelaksanaan-kegiatan-study-tour-ke-museum-nasional',
                'content' => '<p>Pada tanggal 1 November 2025, siswa kelas X melaksanakan kegiatan study tour ke Museum Nasional Jakarta.</p><p>Kegiatan ini bertujuan untuk menambah wawasan siswa tentang sejarah dan kebudayaan Indonesia. Siswa sangat antusias mengikuti kegiatan ini dan mendapatkan banyak ilmu pengetahuan baru.</p><p>Terima kasih kepada semua pihak yang telah mendukung terlaksananya kegiatan ini.</p>',
                'excerpt' => 'Siswa kelas X mengunjungi Museum Nasional untuk menambah wawasan sejarah',
                'category_id' => $categories->where('slug', 'kegiatan')->first()->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Penerapan Kurikulum Merdeka di Sekolah',
                'slug' => 'penerapan-kurikulum-merdeka-di-sekolah',
                'content' => '<p>Mulai tahun ajaran ini, sekolah kami menerapkan Kurikulum Merdeka untuk seluruh tingkatan kelas.</p><p>Kurikulum Merdeka memberikan kebebasan kepada guru untuk mengembangkan pembelajaran yang lebih kreatif dan inovatif sesuai dengan kebutuhan siswa.</p><p>Kami berharap dengan penerapan kurikulum ini, kualitas pendidikan di sekolah kami semakin meningkat.</p>',
                'excerpt' => 'Sekolah menerapkan Kurikulum Merdeka untuk meningkatkan kualitas pembelajaran',
                'category_id' => $categories->where('slug', 'akademik')->first()->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Tim Basket Sekolah Juara 2 Kompetisi Antar Sekolah',
                'slug' => 'tim-basket-sekolah-juara-2-kompetisi-antar-sekolah',
                'content' => '<p>Tim basket putra sekolah kami berhasil meraih juara 2 dalam Kompetisi Basket Antar Sekolah tingkat kota.</p><p>Pertandingan yang berlangsung sengit berhasil dimenangkan dengan skor 78-75 pada babak final. Para pemain menunjukkan kerja sama tim yang sangat baik.</p><p>Selamat kepada tim basket dan pelatih atas prestasi yang membanggakan ini!</p>',
                'excerpt' => 'Tim basket putra meraih juara 2 kompetisi tingkat kota',
                'category_id' => $categories->where('slug', 'prestasi')->first()->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Kegiatan Donor Darah Bersama PMI',
                'slug' => 'kegiatan-donor-darah-bersama-pmi',
                'content' => '<p>Sekolah mengadakan kegiatan donor darah bekerja sama dengan PMI pada tanggal 3 November 2025.</p><p>Kegiatan ini diikuti oleh guru, siswa kelas XII, dan staff sekolah. Total terkumpul 75 kantong darah yang akan disalurkan untuk membantu sesama.</p><p>Terima kasih kepada semua yang telah berpartisipasi dalam kegiatan kemanusiaan ini.</p>',
                'excerpt' => 'Sekolah mengadakan donor darah bersama PMI dengan antusiasme tinggi',
                'category_id' => $categories->where('slug', 'kegiatan')->first()->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Workshop Pengembangan Soft Skills untuk Siswa',
                'slug' => 'workshop-pengembangan-soft-skills-untuk-siswa',
                'content' => '<p>Sekolah mengadakan workshop pengembangan soft skills untuk siswa kelas XI dan XII pada tanggal 28 Oktober 2025.</p><p>Workshop ini menghadirkan narasumber profesional yang memberikan materi tentang komunikasi, leadership, dan time management.</p><p>Siswa sangat antusias dan berharap workshop seperti ini dapat diadakan secara rutin.</p>',
                'excerpt' => 'Workshop soft skills membekali siswa dengan kemampuan non-akademik penting',
                'category_id' => $categories->where('slug', 'akademik')->first()->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'published_at' => now()->subDays(8),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
