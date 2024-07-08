<?php

namespace App\Factory;

use App\DTO\Request\ProjectDto;
use App\Entity\Enum\Status;
use App\Entity\Project;
use DateInterval;
use DateTime;

class ProjectFactory
{
    /**
     * @param Project $project
     */
    public function __construct(private Project $project)
    {}

    public function create(ProjectDto $projectDto): Project
    {
        return $this->project
            ->setTitle($projectDto->title)
            ->setDescription($projectDto->description)
            ->setClient($projectDto->client)
            ->setCompany($projectDto->company)
            ->setStatus(Status::tryFrom($projectDto->status))
            ->setDuration(new DateInterval($projectDto->duration))
            ->setUpdatedAt(new DateTime('now'))
        ;
    }

    public function setProjectEntity(Project $project): self
    {
        $this->project = $project;
        return $this;
    }
}