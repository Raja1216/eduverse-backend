<?php

namespace App\Services;

use App\Repositories\Contracts\EventRepositoryInterface;
use Exception;

class EventService
{
    public function __construct(
        private EventRepositoryInterface $eventRepo
    ) {}

    public function listEvents(array $filters)
    {
        return $this->eventRepo->paginate($filters);
    }

    public function upcomingEvents(int $limit = 6)
    {
        return $this->eventRepo->upcoming($limit);
    }

    public function getEvent(int $id)
    {
        $event = $this->eventRepo->findById($id);

        if (!$event) {
            throw new Exception('Event not found');
        }

        return $event;
    }
}
