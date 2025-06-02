<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts'; // Nama Table (sesuaikan jika perlu)
    protected $primaryKey = 'id'; // Nama Primary Key (sesuaikan jika perlu)

    protected $fillable = [
        'gambar_1',
        'sejarah',
        'gambar_2',
        'visi_misi',
        'jumlah_penduduk',
        'luas_wilayah',
        'jumlah_perangkat_desa',
    ];
        protected $nullable = [
        'create_at',
        'update_at'
    ];
}
