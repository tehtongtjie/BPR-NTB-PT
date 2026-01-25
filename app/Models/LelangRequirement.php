<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LelangRequirement extends Model
{
    protected $table = 'lelang_requirements';

    protected $fillable = [
        'lelang_id',
        'title',
    ];

    /**
     * =====================
     * RELATION
     * =====================
     */
    public function lelang()
    {
        return $this->belongsTo(Lelang::class);
    }
}
