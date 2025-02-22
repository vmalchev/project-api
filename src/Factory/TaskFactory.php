<?php

namespace App\Factory;

use App\DTO\Request\TaskDto;
use App\Entity\Task;
use App\Exception\ProjectNotFoundException;
use App\Repository\ProjectRepository;
use DateTime;
use Symfony\Component\Uid\Uuid;

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
        $project = $this->projectRepository->findById(Uuid::fromString($taskDto->project));

        if (is_null($project)) {
            throw new ProjectNotFoundException("Project with ID '" . $taskDto->project . "' not found.");
        }

        return $this->task
            ->setName($taskDto->name)
            ->setProject($project)
            ->setUpdatedAt(new DateTime('now'))
        ;
    }

    public function setTaskEntity(Task $task): self
    {
        $this->task = $task;
        return $this;
    }
}