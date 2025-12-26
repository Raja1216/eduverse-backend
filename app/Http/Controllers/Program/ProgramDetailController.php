<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Services\ProgramService;

class ProgramDetailController extends Controller
{
    public function __invoke($id, ProgramService $service)
    {
        return response()->json(
            $service->getProgram($id)
        );
    }
}
