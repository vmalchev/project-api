<?php

namespace App\DTO\Request;

use App\DTO\Validator\UuidValidator;
use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class TaskDto implements RequestDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Type("string")]
    #[Assert\Length(
        min: 3,
        max: 25,
        minMessage: 'Task name must be at least {{ limit }} characters long',
        maxMessage: 'Task name cannot be longer than {{ limit }} characters',
    )]
    public string|null $name = null;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Uuid]
    public string|null $project = null;
}