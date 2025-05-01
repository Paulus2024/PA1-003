<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // use HasFactory;
    protected $table = 'peminjaman'; // Nama Table
    protected $fillable = [
        'alat_pertanian_id',
        'peminjama',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    public function alat()
    {
        return $this->belongsTo(AlatPertanian::class, 'alat_pertanian_id', 'id_alat_pertanian');
    }
}
