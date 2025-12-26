<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Http\Request;

class UpcomingEventController extends Controller
{
    public function __invoke(Request $request, EventService $service)
    {
        $limit = $request->get('limit', 6);
        return response()->json(
            $service->upcomingEvents($limit)
        );
    }
}
