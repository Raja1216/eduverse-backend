<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'class',
        'price',
        'event_date',
        'event_time',
        'venue',
        'image',
        'max_participants',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'event_date' => 'date'
    ];
}
