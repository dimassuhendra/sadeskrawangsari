<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_desa', function (Blueprint $table) {
            $table->text('sambutan_kades')->nullable()->after('sejarah');
            $table->string('nama_kades', 100)->nullable()->after('sambutan_kades');
            $table->string('foto_kades')->nullable()->after('nama_kades');
            $table->string('hero_image')->nullable()->after('foto_kades');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_desa', function (Blueprint $table) {
            $table->dropColumn(['sambutan_kades', 'nama_kades', 'foto_kades', 'hero_image']);
        });
    }
};
