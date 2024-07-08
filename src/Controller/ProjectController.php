<?php

namespace App\Controller;

use App\DTO\Request\ProjectDto;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Uid\Uuid;

class ProjectController extends ApiController
{

    public function __construct(private ProjectService $projectService)
    {}

    public function index(): JsonResponse
    {
        return $this->json($this->projectService->list());

    }

    public function create(ProjectDto $dto): JsonResponse
    {
        return $this->json($this->projectService->create($dto));
    }

    public function show(Uuid $id): JsonResponse
    {
        return $this->json($this->projectService->get($id));
    }

    public function update(Uuid $id, ProjectDto $dto): JsonResponse
    {
        return $this->json($this->projectService->edit($id, $dto));
    }

    public function delete(Uuid $id): JsonResponse
    {
        $this->projectService->remove($id);

        return $this->json($id);
    }
}
