<?php

namespace App\Service;

use App\Repository\ProjectRepository;

class ProjectService {
    private $repository;

    public function __construct( ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }
}