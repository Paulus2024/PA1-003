<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAdditionalSection extends Model
{
    use HasFactory;

    protected $table = 'about_additional_sections';//nama table

    protected $fillable = [
        'about_id',
        'title',
        'content',
        'media_file',
    ];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
