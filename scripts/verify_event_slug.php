<?php
// Quick verification script to ensure Event slugs are auto-generated.

use App\Models\Event;
use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$e = new Event([
    'title' => 'Lomba menari',
    'description' => '<p>Lomba menari pada tanggal segitu</p>',
    'starts_at' => '2025-11-07 20:14:18',
    'ends_at' => '2025-11-08 20:14:22',
    'location' => 'Gedung utama',
    'status' => 'scheduled',
    'published_at' => '2025-11-05 20:15:02',
]);
$e->save();

echo "Created event ID={$e->id}, slug={$e->slug}\n";
