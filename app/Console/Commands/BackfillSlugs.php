<?php

namespace App\Console\Commands;

use App\Models\Extracurricular;
use App\Models\GalleryAlbum;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BackfillSlugs extends Command
{
    protected $signature = 'app:backfill-slugs {--dry-run : Only show what would change}';

    protected $description = 'Generate slugs for existing GalleryAlbum & Extracurricular records when missing';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');

        $total = 0;
        $total += $this->backfill(GalleryAlbum::query(), 'title', $dry);
        $total += $this->backfill(Extracurricular::query(), 'name', $dry);

        $this->info("Done. {$total} records processed.");
        return self::SUCCESS;
    }

    /**
    * @param \Illuminate\Database\Eloquent\Builder $query
    */
    protected function backfill($query, string $sourceField, bool $dry): int
    {
        $count = 0;
        $records = $query->whereNull('slug')->orWhere('slug', '')->get();
        foreach ($records as $model) {
            /** @var \Illuminate\Database\Eloquent\Model $model */
            $base = Str::slug((string) $model->getAttribute($sourceField));
            if ($base === '') {
                $base = 'item';
            }

            $slug = $base;
            $i = 2;
            $exists = $model->newQuery()->where('slug', $slug);
            if ($model->exists) {
                $exists->whereKeyNot($model->getKey());
            }
            while ($exists->exists()) {
                $slug = $base . '-' . $i;
                $i++;
                $exists = $model->newQuery()->where('slug', $slug);
                if ($model->exists) {
                    $exists->whereKeyNot($model->getKey());
                }
            }

            if ($dry) {
                $this->line("Would update ID {$model->getKey()} slug => {$slug}");
            } else {
                $model->slug = $slug;
                $model->save();
                $this->line("Updated ID {$model->getKey()} slug => {$slug}");
            }
            $count++;
        }
        return $count;
    }
}
