<?php

namespace App\DTO\Request;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class TaskDto implements RequestDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 25,
        minMessage: 'Task name must be at least {{ limit }} characters long',
        maxMessage: 'Task name cannot be longer than {{ limit }} characters',
    )]
    public string $name;

    #[Assert\NotBlank]
    public Uuid|null $project = null;
}