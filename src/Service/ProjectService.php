<?php

namespace App\Service;

use App\DTO\Request\ProjectDto;
use App\DTO\Response\Mapper\ProjectResponseMapper;
use App\DTO\Response\ProjectResponseDto;
use App\Exception\ProjectNotFoundException;
use App\Exception\ProjectTitleClientExistsException;
use App\Exception\TaskException;
use App\Factory\ProjectFactory;
use App\Repository\Contract\IProjectRepository;
use DateTime;
use Symfony\Component\Uid\Uuid;

class ProjectService
{
    /**
     * @param ProjectFactory $projectFactory
     * @param IProjectRepository $projectRepository
     * @param ProjectResponseMapper $projectResponseMapper
     */
    public function __construct(
        private ProjectFactory $projectFactory,
        private IProjectRepository $projectRepository,
        private ProjectResponseMapper $projectResponseMapper
    ) {}

    public function list(): array
    {
        return $this->projectResponseMapper->mapCollection($this->projectRepository->allNotDeleted());
    }

    public function create(ProjectDto $projectDto): ProjectResponseDto
    {
        $project = $this->projectFactory->create($projectDto);

        if (!is_null($this->projectRepository->findByTitleAndClient($project->getTitle(), $project->getClient()))) {
            throw new ProjectTitleClientExistsException("Client with the title '" . $project->getTitle() . "' already exists.");
        }

        $this->projectRepository->add($project);

        return $this->projectResponseMapper->map($project);
    }

    public function get(Uuid $id): ProjectResponseDto
    {
        $project = $this->projectRepository->findById($id);

        if (is_null($project)) {
            throw new ProjectNotFoundException("Project with ID '" . $id . "' not found.");
        }

        return $this->projectResponseMapper->map($project);
    }

    public function edit(Uuid $id, ProjectDto $projectDto): ProjectResponseDto
    {
        $projectEntity = $this->projectRepository->findById($id);

        if (is_null($projectEntity)) {
            throw new ProjectNotFoundException("Project with ID '" . $id . "' not found.");
        }

        if (!is_null($this->projectRepository->findByTitleAndClient($projectDto->title, $projectDto->client))) {
            throw new ProjectTitleClientExistsException("Client with the title '" . $projectEntity->getTitle() . "' already exists.");
        }

        $project = $this->projectFactory->setProjectEntity($projectEntity)->create($projectDto);
        $this->projectRepository->flush();

        return $this->projectResponseMapper->map($project);

    }

    public function remove(Uuid $id): void
    {
        $projectEntity = $this->projectRepository->findById($id);

        if (is_null($projectEntity)) {
            throw new ProjectNotFoundException('Project with ID "' . $id . '" not found.');
        }
        if (false !== $projectEntity->getTasks()->first()) {
            throw new TaskException('Cannot delete project while it has assigned tasks.');
        }

        $projectEntity->setDeletedAt(new DateTime('now'));
        $this->projectRepository->flush();
    }
}