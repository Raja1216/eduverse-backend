<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Controllers\Controller;
use App\Services\AssessmentService;
use Illuminate\Http\Request;

class AssessmentListController extends Controller
{
    public function __invoke(Request $request, AssessmentService $service)
    {
        return response()->json(
            $service->listAssessments($request->all())
        );
    }
}
