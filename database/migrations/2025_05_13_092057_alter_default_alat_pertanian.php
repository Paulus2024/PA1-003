<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDefaultAlatPertanian extends Migration
{
    public function up()
    {
        Schema::table('alat_pertanian', function (Blueprint $table) {
            $table->enum('status_alat', ['tersedia', 'tidak_tersedia'])
                ->default('tersedia')
                ->change();

            $table->integer('jumlah_tersedia')
                ->default(0)
                ->change();
        });
    }

    public function down()
    {
        Schema::table('alat_pertanian', function (Blueprint $table) {
            $table->enum('status_alat', ['tersedia', 'tidak_tersedia'])
                ->default(null)
                ->change();

            $table->integer('jumlah_tersedia')
                ->default(null)
                ->change();
        });
    }
}
