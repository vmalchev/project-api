<?php

namespace App\Entity;

use App\Entity\Enum\Status;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;
use DateTimeInterface;
use DateInterval;
use DateTime;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\UniqueConstraint(
    name: 'title_client_unique_idx',
    columns: ['title', 'client']
)]
class Project
{
    #[ORM\Id]
    #[ORM\Column(type:"uuid", unique:true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class:UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(type: 'string', length:120)]
    private string $title;

    #[ORM\Column(type: 'string', length:255, nullable: true)]
    private string|null $description = null;

    #[ORM\Column(type: "string", length:25, enumType: Status::class)]
    private Status $status;

    #[ORM\Column(name: 'duration', type: Types::DATEINTERVAL, nullable: true)]
    private DateInterval|null $duration = null;

    #[ORM\Column(type: 'string', length:255, nullable: true)]
    private string|null $client = null;

    #[ORM\Column(type: 'string', length:255, nullable: true)]
    private string|null $company = null;

    #[ORM\OneToMany(targetEntity: "Task", mappedBy: "project", cascade: ['persist', "remove"], fetch: 'LAZY', orphanRemoval: true)]
    private Collection $tasks;
    #[ORM\Column(name: 'deleted_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTimeInterface|null $deletedAt = null;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface|null $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTimeInterface|null $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDuration(): ?DateInterval
    {
        return $this->duration;
    }

    public function setDuration(?DateInterval $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getTasks(): Collection
    {
        return $this->tasks->filter(function (Task $task) {
            return is_null($task->getDeletedAt());
        });
    }

    public function setTasks(Collection $tasks): self
    {
        $this->tasks = $tasks;

        return $this;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
