<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatPertanian extends Model
{
    use HasFactory;

    protected $table = 'alat_pertanian'; // Nama Table
    protected $primaryKey = 'id_alat_pertanian'; // Nama Primary Key

    protected $fillable = [
        'nama_alat_pertanian',
        'jenis_alat',
        'harga_sewa',
        'status_alat',
        'jumlah_alat',
        'gambar_alat',
        'catatan'
    ];

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
