<?php

namespace App\Controller;

use App\DTO\Request\TaskDto;
use App\Service\TaskService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Uid\Uuid;

class TaskController extends ApiController
{
    /**
     * @param TaskService $taskService
     */
    public function __construct(private TaskService $taskService)
    {}

    public function index(): JsonResponse
    {
        return $this->json($this->taskService->list());
    }

    public function create(TaskDto $dto): JsonResponse
    {
        return $this->json( $this->taskService->create($dto));
    }

    public function show(Uuid $id): JsonResponse
    {
        return $this->json($this->taskService->get($id));
    }

    public function update(Uuid $id, TaskDto $dto): JsonResponse
    {
        return $this->json($this->taskService->edit($id, $dto));
    }

    public function delete(Uuid $id): JsonResponse
    {
        $this->taskService->remove($id);

        return $this->json($id);
    }
}
