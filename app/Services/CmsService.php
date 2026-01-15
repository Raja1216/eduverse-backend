<?php

namespace App\Services;

use App\Repositories\Contracts\CmsRepositoryInterface;

class CmsService
{
    public function __construct(
        private CmsRepositoryInterface $cmsRepo
    ) {}

    public function get(string $key)
    {
        return $this->cmsRepo->get($key)?->content ?? [];
    }

    public function set(string $key, array $content)
    {
        return $this->cmsRepo->set($key, $content);
    }

    public function getAll()
    {
        return $this->cmsRepo->getAll();
    }
}
