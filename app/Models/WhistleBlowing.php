<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhistleBlowing extends Model
{
    // Tambahkan baris ini untuk mengunci nama tabel sesuai migrasi
    protected $table = 'whistle_blowings';

    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'kategori',
        'nama_terlapor',
        'lokasi_kejadian',
        'waktu_kejadian',
        'laporan',
    ];
}
