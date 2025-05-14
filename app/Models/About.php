<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar1',
        'sejarah',
        'gambar2',
        'visi_misi',
        'jumlah_penduduk',
        'luas_wilayah',
        'jumlah_perangkat_desa',
    ];
}
