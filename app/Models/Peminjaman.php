<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman'; // Nama Table
    protected $fillable = [
        'alat_pertanian_id',
        'user_id',
        'nama_peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jumlah_alat_di_sewa',
        'status_peminjaman',
        'bukti_pengembalian',
        'status_pengembalian',
        'tanggal_kembali_aktual',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'tanggal_kembali_aktual' => 'datetime', // PENTING
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat()
    {
        return $this->belongsTo(AlatPertanian::class, 'alat_pertanian_id', 'id_alat_pertanian');
    }
}
