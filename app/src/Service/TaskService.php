<?php

namespace App\Service;

use App\Repository\TaskRepository;

class TaskService {
    private $repository;

    public function __construct( TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getOne($id)
    {
        return $this->repository->find($id);
    }

    public function getTotalInvoiced()
    {
        return $this->repository->findTotalInvoiced();
    }

    public function buildResult($sortProject, $sortTime)
    {
        return $this->repository->filter($sortProject, $sortTime);
    }

}