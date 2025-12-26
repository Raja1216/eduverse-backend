<?php

namespace App\Services;

use App\Repositories\Contracts\PublicationRepositoryInterface;
use Exception;

class PublicationService
{
    public function __construct(
        private PublicationRepositoryInterface $publicationRepo
    ) {}

    public function listPublications(array $filters)
    {
        return $this->publicationRepo->paginate($filters);
    }

    public function getPublication(int $id)
    {
        $publication = $this->publicationRepo->findById($id);

        if (!$publication) {
            throw new Exception('Publication not found');
        }

        return $publication;
    }
}
