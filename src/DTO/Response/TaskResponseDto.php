<?php

namespace App\DTO\Response;

class TaskResponseDto
{
    public string $id;

    public string $name;

    public string|null $project_id = null;

    public \DateTimeInterface|null $deletedAt = null;

    public \DateTimeInterface $createdAt;

    public \DateTimeInterface|null $updatedAt = null;

    /**
     * @param string $id
     * @param string $name
     * @param string|null $project_id
     * @param \DateTimeInterface|null $deletedAt
     * @param \DateTimeInterface $createdAt
     * @param \DateTimeInterface|null $updatedAt
     */
    public function __construct(string $id, string $name, string|null $project_id, ?\DateTimeInterface $deletedAt, \DateTimeInterface $createdAt, ?\DateTimeInterface $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->project_id = $project_id;
        $this->deletedAt = $deletedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


}