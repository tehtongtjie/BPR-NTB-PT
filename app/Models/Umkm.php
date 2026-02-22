<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Umkm extends Model
{
    protected $fillable = [
        'slug',
        'nama_usaha',
        'nama_pemilik',
        'bidang_usaha',
        'lokasi',
        'telepon',
        'link_instagram',
        'deskripsi',
        'unggulan',
        'skala',
        'alamat'
    ];

    public function images()
    {
        return $this->hasMany(UmkmImage::class);
    }

    public function products()
    {
        return $this->hasMany(UmkmProduct::class);
    }
}
