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

        'user_id',
        'gambar_1',  // Ubah di sini

        'gambar_1',

        'sejarah',
        'gambar_2',
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
        protected $nullable = [
        'create_at',
        'update_at'
    ];

}
