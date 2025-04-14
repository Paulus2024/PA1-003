<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            DB::statement("ALTER TABLE informasi CHANGE COLUMN lampiran lampiran_informasi VARCHAR(255) NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi', function (Blueprint $table) {
            DB::statement("ALTER TABLE informasi CHANGE COLUMN lampiran_informasi lampiran VARCHAR(255) NOT NULL");
        });
    }
};
