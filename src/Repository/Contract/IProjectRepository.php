<?php

namespace App\Repository\Contract;

use App\Entity\Project;
use Symfony\Component\Uid\Uuid;

interface IProjectRepository
{
    public function allNotDeleted(): array;

    public function add(Project $project): void;

    public function findById(Uuid $id): ?Project;

    public function flush(): void;

    public function findByTitleAndClient(string $title, string $client): ?Project;
}