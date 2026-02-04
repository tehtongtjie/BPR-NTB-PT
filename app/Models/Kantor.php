<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    protected $table = 'kantor';

    protected $fillable = [
        'tipe',
        'nama',
        'alamat',
        'telepon',
        'latitude',
        'longitude',
    ];
}
