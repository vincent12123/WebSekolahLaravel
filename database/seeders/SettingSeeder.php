<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'Portal Sekolah',
                'nama_kepala_sekolah' => 'Ignasius Asong, S.Pd, MAT',
                'logo_url' => null,
                'foto_kepala_sekolah_url' => null,
                'alamat' => 'Jl. Contoh No. 123, Kecamatan, Kota',
                'sambutan_kepala_sekolah' => 'Selamat datang di website resmi SMPN 2 Sintang. Melalui platform ini, kami berkomitmen menghadirkan informasi yang akurat, transparan, dan bermanfaat bagi siswa, orang tua, guru, dan seluruh pemangku kepentingan. Semoga website ini dapat menjadi jembatan komunikasi serta sarana literasi digital yang mendorong prestasi dan karakter peserta didik.',
                'telepon' => '021-1234567',
                'email_kontak' => 'info@sekolah.sch.id',
                'jam_operasional' => 'Senin - Jumat, 08.00 - 16.00',
                'link_facebook' => null,
                'link_instagram' => null,
                'link_youtube' => null,
            ]
        );
    }
}
