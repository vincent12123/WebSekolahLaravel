<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: The app uses polymorphic tagging via the 'taggables' table.
        // A dedicated 'article_tag' pivot is not required.
    }

    public function down(): void
    {
        // No-op
    }
};
