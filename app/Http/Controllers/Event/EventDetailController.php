<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Services\EventService;

class EventDetailController extends Controller
{
    public function __invoke(int $id, EventService $service)
    {
        return response()->json(
            $service->getEvent($id)
        );
    }
}
