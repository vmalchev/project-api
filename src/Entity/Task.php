<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use DateTime;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[ORM\UniqueConstraint(
    name: 'name_project_unique_idx',
    columns: ['name', 'project_id']
)]
class Task
{
    #[ORM\Id]
    #[ORM\Column(type:"uuid", unique:true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class:UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(type: 'string', length:25)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: "Project", inversedBy: "tasks")]
    #[ORM\JoinColumn(name: "project_id", referencedColumnName: "id")]
    private Project|null $project = null;

    #[ORM\Column(name: 'deleted_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTimeInterface|null $deletedAt = null;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $createdAt;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private DateTimeInterface|null $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;
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

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
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
