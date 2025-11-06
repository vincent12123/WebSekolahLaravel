<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Seed the application's tags table.
     */
    public function run(): void
    {
        // Seed bilingual tags (id & en). If you change translations, re-run this seeder.
        $tags = [
            ['id' => 'Prestasi',    'en' => 'Achievement'],
            ['id' => 'Kegiatan',    'en' => 'Activities'],
            ['id' => 'Lingkungan',  'en' => 'Environment'],
            ['id' => 'P5',          'en' => 'P5'],
            ['id' => 'OSN',         'en' => 'OSN'],
            ['id' => 'BNN',         'en' => 'BNN'],
            ['id' => 'Sekolah',     'en' => 'School'],
            ['id' => 'Pengumuman',  'en' => 'Announcement'],
        ];

        foreach ($tags as $label) {
            $idName = $label['id'];
            $enName = $label['en'];

            $idSlug = Str::slug($idName);
            $enSlug = Str::slug($enName);

            // Find by Indonesian slug inside JSON column to keep a single record per tag concept
            $existing = Tag::where('slug->id', $idSlug)->first();

            if (!$existing) {
                Tag::create([
                    'name' => [ 'id' => $idName, 'en' => $enName ],
                    'slug' => [ 'id' => $idSlug, 'en' => $enSlug ],
                ]);
            } else {
                // Ensure both locales are populated if previously created with one locale only
                $name = $existing->name ?: [];
                $slug = $existing->slug ?: [];
                $name['id'] = $name['id'] ?? $idName;
                $name['en'] = $name['en'] ?? $enName;
                $slug['id'] = $slug['id'] ?? $idSlug;
                $slug['en'] = $slug['en'] ?? $enSlug;
                $existing->update(compact('name', 'slug'));
            }
        }

        // Optionally attach some tags to existing seeded articles for demo purposes
        $bySlug = fn ($slug) => Article::where('slug', $slug)->first();
        $tagId = fn ($idSlug) => optional(Tag::where('slug->id', $idSlug)->first())->id;

        $attachments = [
            'siswi-smpn-2-sintang-ikuti-osn-tingkat-nasional-2024' => ['osn', 'prestasi', 'sekolah'],
            'smpn-2-sintang-raih-penghargaan-dari-bnn-ri'          => ['bnn', 'prestasi'],
            'gelar-karya-p5-smpn-2-sintang-bangun-jiwa-kewirausahaan' => ['p5', 'kegiatan'],
            'peringati-hari-bumi-siswa-tanam-pohon-dan-luncurkan-lost-toxic-less-plastic' => ['lingkungan', 'kegiatan'],
            'ignasius-asong-ditunjuk-pimpin-smpn-2-sintang-diharapkan-bawa-perubahan' => ['sekolah', 'pengumuman'],
        ];

        foreach ($attachments as $articleSlug => $idSlugs) {
            $article = $bySlug($articleSlug);
            if (!$article) continue;

            $tagIds = array_values(array_filter(array_map($tagId, $idSlugs)));
            if (!empty($tagIds)) {
                $article->tags()->syncWithoutDetaching($tagIds);
            }
        }
    }
}
