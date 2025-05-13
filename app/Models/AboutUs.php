<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar1',
        'visi_misi',
        'gambar2',
        'sejarah',
        'jumlah_penduduk',
        'luas_wilayah',
        'jumlah_perangkat_desa',
    ];
}
