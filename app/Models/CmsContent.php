<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    protected $fillable = ['key', 'content'];

    protected $casts = [
        'content' => 'array'
    ];
}
