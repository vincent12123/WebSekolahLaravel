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
                'logo_url' => null,
                'alamat' => 'Jl. Contoh No. 123, Kecamatan, Kota',
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
