<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Lelang extends Model
{
    protected $table = 'lelangs';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'status',
        'deadline',
        'banner',
        'short_desc',
        'description',
        'rks_file',
        'is_published',
    ];

    protected $casts = [
        'deadline'     => 'date',
        'is_published' => 'boolean',
    ];

    /**
     * =====================
     * RELATION
     * =====================
     */
    public function requirements()
    {
        return $this->hasMany(LelangRequirement::class);
    }

    /**
     * =====================
     * ACCESSOR (OPTIONAL)
     * =====================
     */
    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => ucfirst($this->status)
        );
    }

    protected function deadlineFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->deadline
                ? $this->deadline->format('d M Y')
                : null
        );
    }

    /**
     * =====================
     * BOOT (AUTO SLUG)
     * =====================
     */
    protected static function booted()
    {
        static::creating(function ($lelang) {
            if (empty($lelang->slug)) {
                $lelang->slug = Str::slug($lelang->title) . '-' . uniqid();
            }
        });
    }
}
