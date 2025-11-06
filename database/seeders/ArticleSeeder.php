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
                'title' => 'Siswi SMPN 2 Sintang Ikuti OSN Tingkat Nasional 2024',
                'slug' => 'siswi-smpn-2-sintang-ikuti-osn-tingkat-nasional-2024',
                'content' => '<p>Kami dengan bangga mengumumkan bahwa siswi kami, <strong>ElIsabeth Uci</strong>, berhasil berpartisipasi dalam Olimpiade Sains Nasional (OSN) Tingkat Nasional pada tahun 2024.</p><p>Keikutsertaan ini menjadi bukti komitmen sekolah dalam mengembangkan potensi siswa di bidang sains agar mampu bersaing di tingkat global. Kepala SMP Negeri 2 Sintang, Ignasius Asong, S.Pd Mat., turut memberikan dukungan penuh.</p>',
                'excerpt' => 'ElIsabeth Uci dari SMPN 2 Sintang berpartisipasi dalam OSN Tingkat Nasional 2024 bidang sains.',
                'category_id' => $categories->where('slug', 'prestasi')->first()->id,
                'user_id' => $admin->id,
                'image_url' => 'https://placehold.co/1200x600?text=OSN+2024',
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'SMPN 2 Sintang Raih Penghargaan dari BNN RI',
                'slug' => 'smpn-2-sintang-raih-penghargaan-dari-bnn-ri',
                'content' => '<p>SMP Negeri 2 Sintang kembali mengukir prestasi di tingkat nasional dengan meraih penghargaan dari Badan Narkotika Nasional Republik Indonesia (BNN RI).</p><p>Penghargaan ini didapat atas partisipasi aktif sekolah dalam kegiatan Gema War On Drugs. Prestasi ini menjadikan SMPN 2 Sintang sebagai contoh positif dalam perang melawan narkoba di lingkungan pendidikan.</p>',
                'excerpt' => 'Atas partisipasi aktif dalam Gema War On Drugs, SMPN 2 Sintang mendapat penghargaan nasional dari BNN RI.',
                'category_id' => $categories->where('slug', 'prestasi')->first()->id,
                'user_id' => $admin->id,
                'image_url' => 'https://placehold.co/1200x600?text=BNN+RI',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Gelar Karya P5 SMPN 2 Sintang, Bangun Jiwa Kewirausahaan Lewat "MARKET SPANDA"',
                'slug' => 'gelar-karya-p5-smpn-2-sintang-bangun-jiwa-kewirausahaan',
                'content' => '<p>SMPN 2 Sintang sukses menggelar acara Gelar Karya P5 (Proyek Penguatan Profil Pelajar Pancasila) dengan tema "Bangun Jiwa Raga dan Kewirausahaan".</p><p>Acara ini menampilkan "MARKET SPANDA", sebuah miniatur pasar di mana siswa bertransaksi menggunakan mata uang khusus bernama "Spanda" yang dicetak oleh sekolah. Kegiatan ini bertujuan mengasah potensi diri, pemahaman diri, dan peran sosial siswa.</p><p>Selain itu, ditampilkan juga Gelar Karya P5 Lintas Agama sebagai wujud toleransi dalam kebhinekaan.</p>',
                'excerpt' => 'SMPN 2 Sintang menggelar Gelar Karya P5 dengan tema kewirausahaan, menampilkan "MARKET SPANDA" dengan mata uang khusus.',
                'category_id' => $categories->where('slug', 'kegiatan')->first()->id,
                'user_id' => $admin->id,
                'image_url' => 'https://placehold.co/1200x600?text=Gelar+Karya+P5',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Peringati Hari Bumi, Siswa Tanam Pohon dan Luncurkan "Lost Toxic, Less Plastic"',
                'slug' => 'peringati-hari-bumi-siswa-tanam-pohon-dan-luncurkan-lost-toxic-less-plastic',
                'content' => '<p>Dalam rangka memperingati Hari Bumi, siswa-siswi SMPN 2 Sintang melakukan aksi sosial dengan menanam pohon di sekitar lingkungan sekolah.</p><p>Tidak hanya itu, sekolah juga meluncurkan proyek kokurikuler "Lost Toxic, Less Plastic". Kepala SMP Negeri 2 Sintang, Ignasius Asong, berharap program ini dapat memberikan dampak positif nyata bagi karakter siswa dan kelestarian lingkungan.</p>',
                'excerpt' => 'Siswa SMPN 2 Sintang menanam pohon dan meluncurkan program "Lost Toxic, Less Plastic" untuk memperingati Hari Bumi.',
                'category_id' => $categories->where('slug', 'kegiatan')->first()->id,
                'user_id' => $admin->id,
                'image_url' => 'https://placehold.co/1200x600?text=Hari+Bumi',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Ignasius Asong Ditunjuk Pimpin SMPN 2 Sintang, Diharapkan Bawa Perubahan',
                'slug' => 'ignasius-asong-ditunjuk-pimpin-smpn-2-sintang-diharapkan-bawa-perubahan',
                'content' => '<p>Bapak <strong>Ignasius Asong, S.Pd, MAT</strong>, ditunjuk sebagai Pelaksana Tugas (Plt) Kepala SMP Negeri 2 Sintang.</p><p>Dinas Pendidikan dan Kebudayaan Kabupaten Sintang berharap kepemimpinan baru ini dapat membawa perubahan positif. SMPN 2 Sintang merupakan salah satu sekolah terbesar di kota Sintang, yang memiliki 30 rombongan belajar dan 945 siswa.</p>',
                'excerpt' => 'Ignasius Asong ditunjuk sebagai Plt Kepala SMPN 2 Sintang, diharapkan membawa kemajuan bagi sekolah terbesar di Sintang tersebut.',
                'category_id' => $categories->where('slug', 'berita-sekolah')->first()->id,
                'user_id' => $admin->id,
                'image_url' => 'https://placehold.co/1200x600?text=Kepala+Sekolah',
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}