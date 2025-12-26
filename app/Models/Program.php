<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'code',
        'category',
        'sub_category',
        'product_name',
        'class',
        'subject',
        'duration',
        'mode',
        'mrp',
        'selling_price',
        'installments',
        'cost_per_month',
        'image',
        'description',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean'
    ];
}
