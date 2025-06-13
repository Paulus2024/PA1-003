<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengurusDesa extends Model
{
    use HasFactory;

    protected $table = 'data_pengurus_desas';
    protected $primaryKey = 'id_data_pengurus_desa';

    protected $fillable = [
        'user_id',
        'jabatan_id', // Ganti 'jabatan_data_pengurus_desa' dengan 'jabatan_id'
        'nama_data_pengurus_desa',
        'deskripsi_data_pengurus_desa',
        'gambar_data_pengurus_desa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the Jabatan associated with the DataPengurusDesa.
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }
    
    protected $nullable = [
        'create_at',
        'update_at'
    ];
}


