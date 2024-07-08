<?php

namespace App\Repository\Contract;

use App\Entity\Project;
use App\Entity\Task;
use Symfony\Component\Uid\Uuid;

interface ITaskRepository
{
    public function allNotDeleted(): array;

    public function add(Task $task): void;

    public function findById(Uuid $id): ?Task;

    public function findByNameAndProject(string $name, Project $project): ?Task;

    public function flush(): void;
}