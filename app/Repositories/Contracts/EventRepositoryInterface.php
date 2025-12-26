<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Event;

interface EventRepositoryInterface
{
    public function paginate(array $filters): LengthAwarePaginator;
    public function upcoming(int $limit = 6);
    public function findById(int $id): ?Event;
}
