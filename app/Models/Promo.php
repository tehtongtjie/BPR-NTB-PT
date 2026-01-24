<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_desc',
        'description',
        'is_active',
    ];

    /**
     * RELATION: Promo -> Benefits
     */
    public function benefits()
    {
        return $this->hasMany(PromoBenefit::class);
    }

    /**
     * RELATION: Promo -> Requirements
     */
    public function requirements()
    {
        return $this->hasMany(PromoRequirement::class);
    }
}
