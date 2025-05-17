<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ID penerima notifikasi (admin)
        'type',      // Tipe notifikasi (misalnya, 'peminjaman_baru')
        'data',      // Data terkait notifikasi (misalnya, ID peminjaman)
        'read_at',   // Kapan notifikasi dibaca (nullable)
    ];

    protected $casts = [
        'data' => 'array', // Pastikan field 'data' di-cast sebagai array
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
