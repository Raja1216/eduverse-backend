<?php

namespace App\Repositories\Eloquent;

use App\Models\CmsContent;
use App\Repositories\Contracts\CmsRepositoryInterface;

class CmsRepository implements CmsRepositoryInterface
{
    public function get(string $key): ?CmsContent
    {
        return CmsContent::where('key', $key)->first();
    }

    public function set(string $key, array $content): CmsContent
    {
        return CmsContent::updateOrCreate(
            ['key' => $key],
            ['content' => $content]
        );
    }

    public function getAll(): array
    {
        return CmsContent::pluck('content', 'key')->toArray();
    }
}
