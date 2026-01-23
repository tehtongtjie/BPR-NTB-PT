<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_desc',
        'image',
        'is_active',
    ];

}
