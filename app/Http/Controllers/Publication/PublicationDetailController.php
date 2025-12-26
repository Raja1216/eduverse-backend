<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Services\PublicationService;

class PublicationDetailController extends Controller
{
    public function __invoke(int $id, PublicationService $service)
    {
        return response()->json(
            $service->getPublication($id)
        );
    }
}
