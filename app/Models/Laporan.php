<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';

    protected $fillable = [
        'tipe',
        'jenis',
        'tahun',
        'judul',
        'file',
    ];
}
