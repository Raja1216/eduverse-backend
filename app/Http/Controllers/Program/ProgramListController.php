<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Services\ProgramService;
use Illuminate\Http\Request;

class ProgramListController extends Controller
{
    public function __invoke(Request $request, ProgramService $service)
    {
        return response()->json(
            $service->listPrograms($request->all())
        );
    }
}
