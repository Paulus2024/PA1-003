<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'kata_sambutan_kepala_desa',
        'media_file',
        'gambar_1',
        'sejarah',
        'gambar_2',
        'visi',
        'misi',
        'jumlah_penduduk',
        'luas_wilayah',
        'jumlah_perangkat_desa',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function additionalSections()
    {
        return $this->hasMany(AboutAdditionalSection::class);
    }

    protected $nullable = [
        'create_at',
        'update_at'
    ];
}
