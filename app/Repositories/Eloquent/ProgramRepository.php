<?php

namespace App\Repositories\Eloquent;

use App\Models\Program;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProgramRepository implements ProgramRepositoryInterface
{
    public function paginate(array $filters): LengthAwarePaginator
    {
        $query = Program::where('is_active', true);

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        if (!empty($filters['subject'])) {
            $query->where('subject', $filters['subject']);
        }

        if (!empty($filters['mode'])) {
            $query->where('mode', $filters['mode']);
        }

        return $query->paginate($filters['limit'] ?? 10);
    }

    public function findById(int $id): ?Program
    {
        return Program::where('is_active', true)->find($id);
    }
}
