<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Run all seeders in order
        $this->call([
            SettingSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            AnnouncementSeeder::class,
            ArticleSeeder::class,
            GallerySeeder::class,
            DownloadSeeder::class,
            ExtracurricularSeeder::class,
            JobSeeder::class,
            StaffSeeder::class,
            EventSeeder::class,
        ]);
    }
}
