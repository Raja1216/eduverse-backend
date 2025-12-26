<?php

namespace App\Repositories\Eloquent;

use App\Models\Publication;
use App\Repositories\Contracts\PublicationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PublicationRepository implements PublicationRepositoryInterface
{
    public function paginate(array $filters): LengthAwarePaginator
    {
        $query = Publication::where('is_active', true);

        if (!empty($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        return $query->paginate($filters['limit'] ?? 10);
    }

    public function findById(int $id): ?Publication
    {
        return Publication::where('is_active', true)->find($id);
    }
}
