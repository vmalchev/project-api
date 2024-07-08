<?php

namespace App\DTO\Response\Mapper;

use App\DTO\Response\ProjectResponseDto;
use App\Entity\Project;
use Doctrine\Common\Collections\Collection;

class ProjectResponseMapper
{
    public function map(Project $project): ProjectResponseDto
    {
        return new ProjectResponseDto(
            $project->getId(),
            $project->getTitle(),
            $project->getDescription(),
            $project->getStatus()->value,
            $project->getDuration(),
            $project->getClient(),
            $project->getCompany(),
            (new TaskResponseMapper())->mapCollection($project->getTasks()),
            $project->getDeletedAt(),
            $project->getCreatedAt(),
            $project->getUpdatedAt(),
        );
    }

    public function mapCollection(array|Collection $projects): array
    {
        $projectCollection = [];

        foreach ($projects as $project) {
            $projectCollection[] = $this->map($project);
        }

        return $projectCollection;
    }
}