<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class EventRepository implements EventRepositoryInterface
{
    public function paginate(array $filters): LengthAwarePaginator
    {
        $query = Event::where('is_active', true);

        if (!empty($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        if (!empty($filters['upcoming'])) {
            $query->whereDate('event_date', '>=', Carbon::today());
        }

        return $query
            ->orderBy('event_date')
            ->paginate($filters['limit'] ?? 10);
    }

    public function upcoming(int $limit = 6)
    {
        return Event::where('is_active', true)
            ->whereDate('event_date', '>=', Carbon::today())
            ->orderBy('event_date')
            ->limit($limit)
            ->get();
    }

    public function findById(int $id): ?Event
    {
        return Event::where('is_active', true)->find($id);
    }
}
