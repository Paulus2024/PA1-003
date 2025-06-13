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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id(); // Ini akan menjadi primary key: 'id'
            $table->string('nama_jabatan')->unique(); // Nama jabatan, harus unik
            $table->text('deskripsi_jabatan')->nullable(); // Deskripsi tambahan untuk jabatan
            $table->timestamps();
        });

        // Tambahkan kolom foreign key 'jabatan_id' ke tabel 'data_pengurus_desas'
        Schema::table('data_pengurus_desas', function (Blueprint $table) {
            // Hapus kolom 'jabatan_data_pengurus_desa' yang lama jika ada
            // Pastikan tidak ada data yang akan hilang jika Anda sudah punya data di production
            $table->dropColumn('jabatan_data_pengurus_desa');

            // Tambahkan kolom 'jabatan_id' sebagai unsignedBigInteger
            $table->foreignId('jabatan_id')
                ->nullable() // Mengizinkan null jika suatu jabatan belum diisi
                ->constrained('jabatan') // Foreign key ke tabel 'jabatan'
                ->onDelete('set null'); // Jika jabatan dihapus, set pengurus.jabatan_id menjadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pengurus_desas', function (Blueprint $table) {
            $table->dropForeign(['jabatan_id']); // Hapus foreign key
            $table->dropColumn('jabatan_id'); // Hapus kolom foreign key
            $table->string('jabatan_data_pengurus_desa')->nullable(); // Kembalikan kolom lama (optional, jika rollback)
        });
        Schema::dropIfExists('jabatan');
    }
};
