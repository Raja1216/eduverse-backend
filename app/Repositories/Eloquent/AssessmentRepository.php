<?php

namespace App\Repositories\Eloquent;

use App\Models\Assessment;
use App\Repositories\Contracts\AssessmentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AssessmentRepository implements AssessmentRepositoryInterface
{
    public function paginate(array $filters): LengthAwarePaginator
    {
        $query = Assessment::where('is_active', true);

        if (!empty($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        return $query->paginate($filters['limit'] ?? 10);
    }

    public function findById(int $id): ?Assessment
    {
        return Assessment::where('is_active', true)->find($id);
    }
}
