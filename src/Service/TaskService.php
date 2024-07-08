<?php

namespace App\Service;

use App\DTO\Request\TaskDto;
use App\DTO\Response\Mapper\TaskResponseMapper;
use App\DTO\Response\TaskResponseDto;
use App\Exception\TaskException;
use App\Exception\TaskNameProjectExistsException;
use App\Exception\TaskNotFoundException;
use App\Factory\TaskFactory;
use App\Repository\Contract\ITaskRepository;
use DateTime;
use Symfony\Component\Uid\Uuid;

class TaskService
{
    /**
     * @param TaskFactory $taskFactory
     * @param ITaskRepository $taskRepository
     * @param TaskResponseMapper $taskResponseMapper
     */
    public function __construct(
        private TaskFactory $taskFactory,
        private ITaskRepository $taskRepository,
        private TaskResponseMapper $taskResponseMapper
    ) {}

    public function list(): array
    {
        return $this->taskResponseMapper->mapCollection($this->taskRepository->allNotDeleted());
    }

    public function create(TaskDto $taskDto): TaskResponseDto
    {
        $task = $this->taskFactory->create($taskDto);

        if (!is_null($this->taskRepository->findByNameAndProject($task->getName(), $task->getProject()))) {
            throw new TaskNameProjectExistsException("Task with the name '" . $task->getName() . "' assign to project '" . $task->getProject()->getTitle() . "' already exists.");
        }

        $this->taskRepository->add($task);


        return $this->taskResponseMapper->map($task);
    }

    public function get(Uuid $id): TaskResponseDto
    {
        $task = $this->taskRepository->findById($id);

        if (is_null($task)) {
            throw new TaskNotFoundException("Task with ID '" . $id . "' not found.");
        }

        return $this->taskResponseMapper->map($task);
    }

    public function edit(Uuid $id, TaskDto $taskDto): TaskResponseDto
    {
        $taskEntity = $this->taskRepository->findById($id);

        if (is_null($taskEntity)) {
            throw new TaskNotFoundException("Task with ID '" . $id . "' not found.");
        }

        $task = $this->taskFactory->setTaskEntity($taskEntity)->create($taskDto);
        $this->taskRepository->flush();


        return $this->taskResponseMapper->map($task);
    }

    public function remove(Uuid $id): void
    {
        $taskEntity = $this->taskRepository->findById($id);

        if (is_null($taskEntity)) {
            throw new TaskNotFoundException("Task with ID '" . $id . "' not found.");
        }

        $taskEntity->setDeletedAt(new DateTime('now'));
        $this->taskRepository->flush();
    }

}