<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRecruit extends Model
{
    protected $table = 'job_recruits';

    protected $casts = [
        'deadline' => 'date',
        'is_featured' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'location',
        'description',
        'requirements',
        'salary_range',
        'status',
        'deadline',
        'is_featured',
        'url_recruits',
    ];
}
