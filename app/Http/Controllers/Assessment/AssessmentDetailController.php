<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Controllers\Controller;
use App\Services\AssessmentService;

class AssessmentDetailController extends Controller
{
    public function __invoke(int $id, AssessmentService $service)
    {
        return response()->json(
            $service->getAssessment($id)
        );
    }
}
