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
        Schema::table('abouts', function (Blueprint $table) {
            //* Buat Kolom Baru
            $table->text('visi')->nullable()->after('sejarah');
            $table->text('misi')->nullable()->after('visi');

            //* Hapus Kolom Lama
            $table->dropColumn('visi_misi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->text('visi_misi')->nullable()->after('sejarah');

            $table->dropColum('visi');
            $table->dropColum('misi');
        });
    }
};
