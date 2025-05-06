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
        Schema::create('peminjaman', function (Blueprint $t) {
            $t->id();
            $t->foreignId('alat_pertanian_id')//alat_pertanian_id akan menjadi foreign key
                ->constrained('alat_pertanian', 'id_alat_pertanian')//bagian ini menandakan bahwa kolom alat_pertanain_id adalah foreigin key yang mengacu pada kolom id_alat_pertanian di table alat_pertanian
                ->onUpdate('cascade')//jika ada perubahan pada id_alat_pertanian di table alat_pertanian, maka id_alat_pertanian di table peminjaman juga akan berubah
                ->onDelete('cascade');
            $t->string('pemijaman');
            $t->date('tanggal_pinjam');
            $t->date('tanggal_kembali');
            $t->enum('status_peminjaman',['menunggu', 'disetujui', 'ditolak'])->default('mmenunggu');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
