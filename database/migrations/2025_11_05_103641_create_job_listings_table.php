<?php
// database/migrations/xxxx_xx_xx_000014_create_job_listings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('job_type')->nullable(); // cth: Penuh Waktu
            $table->string('location')->nullable();
            $table->text('description');
            $table->text('requirements');
            $table->date('deadline')->nullable();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
