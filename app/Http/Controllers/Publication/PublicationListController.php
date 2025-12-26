<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Services\PublicationService;
use Illuminate\Http\Request;

class PublicationListController extends Controller
{
    public function __invoke(Request $request, PublicationService $service)
    {
        return response()->json(
            $service->listPublications($request->all())
        );
    }
}
