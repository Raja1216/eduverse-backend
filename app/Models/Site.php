<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
   protected $fillable = [
        'name',
        'slug',
        'domain',
        'logo_url',
        'is_active'
    ];
}
