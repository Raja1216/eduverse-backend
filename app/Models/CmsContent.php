<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    protected $fillable = ['site_id', 'section_key', 'content', 'is_active'];
    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];
}
