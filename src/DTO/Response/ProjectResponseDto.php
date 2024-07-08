<?php

namespace App\DTO\Response;

class ProjectResponseDto
{
    public string $id;
    public string $title;

    public string|null $description = null;

    public string $status;

    public \DateInterval|null $duration = null;

    public string|null $client = null;

    public string|null $company = null;

    public array $tasks;

    public \DateTimeInterface|null $deletedAt = null;

    public \DateTimeInterface|null $createdAt = null;

    public \DateTimeInterface|null $updatedAt = null;

    /**
     * @param string $id
     * @param string $title
     * @param string|null $description
     * @param string $status
     * @param \DateInterval|null $duration
     * @param string|null $client
     * @param string|null $company
     * @param array $tasks
     * @param \DateTimeInterface|null $deletedAt
     * @param \DateTimeInterface|null $createdAt
     * @param \DateTimeInterface|null $updatedAt
     */
    public function __construct(string $id, string $title, ?string $description, string $status, \DateInterval|null $duration, ?string $client, ?string $company, array $tasks, ?\DateTimeInterface $deletedAt, ?\DateTimeInterface $createdAt, ?\DateTimeInterface $updatedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->duration = $duration;
        $this->client = $client;
        $this->company = $company;
        $this->tasks = $tasks;
        $this->deletedAt = $deletedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


}