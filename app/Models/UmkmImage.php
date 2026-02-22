<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmImage extends Model
{
    protected $table = 'umkm_images';

    protected $fillable = [
        'umkm_id',
        'image_path',
        'is_thumbnail',
    ];

    protected $casts = [
        'is_thumbnail' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR (Optional - auto asset path)
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
