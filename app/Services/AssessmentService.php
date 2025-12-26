<?php

namespace App\Services;

use App\Repositories\Contracts\AssessmentRepositoryInterface;
use Exception;

class AssessmentService
{
    public function __construct(
        private AssessmentRepositoryInterface $assessmentRepo
    ) {}

    public function listAssessments(array $filters)
    {
        return $this->assessmentRepo->paginate($filters);
    }

    public function getAssessment(int $id)
    {
        $assessment = $this->assessmentRepo->findById($id);

        if (!$assessment) {
            throw new Exception('Assessment not found');
        }

        return $assessment;
    }
}
