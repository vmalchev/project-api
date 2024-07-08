<?php

namespace App\Factory;

use App\DTO\Request\TaskDto;
use App\Entity\Task;
use App\Repository\ProjectRepository;
use DateTime;

class TaskFactory
{
    /**
     * @param Task $task
     * @param ProjectRepository $projectRepository
     */
    public function __construct(private Task $task, private ProjectRepository $projectRepository)
    {}

    public function create(TaskDto $taskDto): Task
    {
        return $this->task
            ->setName($taskDto->name)
            ->setProject($this->projectRepository->findById($taskDto->project))
            ->setUpdatedAt(new DateTime('now'))
        ;
    }

    public function setTaskEntity(Task $task): self
    {
        $this->task = $task;
        return $this;
    }
}