<?php

namespace App\Service;

use App\Repository\TaskRepository;

class TaskService {
    private $repository;

    public function __construct( TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getTotalInvoiced()
    {
        return $this->repository->findTotalInvoiced();
    }

    public function buildResult($project)
    {
        return $this->repository->filter($project);
    }

}