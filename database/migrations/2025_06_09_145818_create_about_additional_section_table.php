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
        Schema::create('about_additional_sections', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel 'abouts'
            $table->foreignId('about_id')->constrained('abouts')->onDelete('cascade');

            $table->string('title'); // Judul tambahan (misal: "Kata Sambutan Pak RT")
            $table->longText('content'); // Konten/isi (akan disimpan sebagai HTML dari TinyMCE)
            $table->string('media_file')->nullable(); // Opsional: gambar/video untuk bagian ini
            // Anda bisa menambahkan kolom lain di sini, misalnya:
            // $table->integer('order')->nullable(); // Untuk mengurutkan tampilan
            // $table->boolean('is_active')->default(true); // Untuk mengaktifkan/menonaktifkan

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_additional_sections');
    }
};
