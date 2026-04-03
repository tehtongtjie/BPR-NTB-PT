<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiplayDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'slug',
        'description',
        'file_path',
        'is_active',
    ];
}
