<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventListController extends Controller
{
    public function __invoke(Request $request, EventService $service)
    {
        return response()->json(
            $service->listEvents($request->all())
        );
    }
}
