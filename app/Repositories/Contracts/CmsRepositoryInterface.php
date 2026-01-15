<?php

namespace App\Repositories\Contracts;

use App\Models\CmsContent;

interface CmsRepositoryInterface
{
    public function get(string $key): ?CmsContent;
    public function set(string $key, array $content): CmsContent;
    public function getAll(): array;
}
