<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'images',
        'class',
        'subject',
        'category',
        'colors',
        'sizes',
        'stock',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'colors' => 'array',
        'sizes' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];
}
