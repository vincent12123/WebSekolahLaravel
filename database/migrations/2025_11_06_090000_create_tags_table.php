<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: The project already defines polymorphic tagging tables
        // in 2025_11_03_214451_create_tag_tables.php (tags + taggables).
        // This migration is intentionally disabled to avoid conflicts.
    }

    public function down(): void
    {
        // No-op
    }
};
