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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ID penerima (admin)
            $table->string('type');      // Tipe notifikasi (misalnya, 'peminjaman_baru')
            $table->json('data');        // Data terkait (misalnya, {'peminjaman_id': 1})
            $table->timestamp('read_at')->nullable(); // Kapan dibaca
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
