<?php

namespace App\Services;

use App\Repositories\Contracts\ProgramRepositoryInterface;
use Exception;

class ProgramService
{
    public function __construct(
        private ProgramRepositoryInterface $programRepo
    ) {}

    public function listPrograms(array $filters)
    {
        return $this->programRepo->paginate($filters);
    }

    public function getProgram(int $id)
    {
        $program = $this->programRepo->findById($id);

        if (!$program) {
            throw new Exception('Program not found');
        }

        return $program;
    }
}
