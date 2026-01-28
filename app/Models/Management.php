<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    
    protected $table = 'managements';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'position',
        'image',
        'excerpt',
        'profile',
        'order',
        'is_active',
    ];
}
