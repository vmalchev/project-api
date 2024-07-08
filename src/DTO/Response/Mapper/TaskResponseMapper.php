<?php

namespace App\DTO\Response\Mapper;

use App\DTO\Response\TaskResponseDto;
use App\Entity\Task;
use Doctrine\Common\Collections\Collection;

class TaskResponseMapper
{
    public function map(Task $task): TaskResponseDto
    {
        return new TaskResponseDto(
            $task->getId(),
            $task->getName(),
            $task->getProject()->getId(),
            $task->getDeletedAt(),
            $task->getCreatedAt(),
            $task->getUpdatedAt()
        );
    }

    public function mapCollection(array|Collection $tasks): array
    {
        $taskCollection = [];

        foreach ($tasks as $task) {
            $taskCollection[] = $this->map($task);
        }

        return $taskCollection;
    }
}