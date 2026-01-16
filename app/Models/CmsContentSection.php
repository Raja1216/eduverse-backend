<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CmsContentSection extends Model
{
    protected $fillable = ['section_key', 'content', 'is_active'];
    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];
}
