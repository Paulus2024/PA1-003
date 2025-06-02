<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'message',
        'is_approved',
    ];

    public function user()
    {
        // 'user_id' adalah foreign key di tabel 'messages'
        // 'id' adalah primary key di tabel 'users' (sesuaikan jika berbeda)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
