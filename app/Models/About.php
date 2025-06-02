<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gambar_1',  // Ubah di sini
        'sejarah',
        'gambar_2',  // Ubah di sini
        'visi_misi',
        'jumlah_penduduk',
        'luas_wilayah',
        'jumlah_perangkat_desa',
    ];
    
    public function user()
    {
        // 'user_id' adalah foreign key di tabel 'abouts'
        // 'id' adalah primary key di tabel 'users' (sesuaikan jika berbeda)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
