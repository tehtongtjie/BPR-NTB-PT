<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'type',
        'thumbnail',
        'description',
        'video_url',
        'published_at',
        'is_published',
    ];
}
