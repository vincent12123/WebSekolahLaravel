<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('nama_kepala_sekolah')->nullable()->after('nama_sekolah');
            $table->string('foto_kepala_sekolah_url')->nullable()->after('logo_url');
            $table->text('sambutan_kepala_sekolah')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['nama_kepala_sekolah', 'foto_kepala_sekolah_url', 'sambutan_kepala_sekolah']);
        });
    }
};
