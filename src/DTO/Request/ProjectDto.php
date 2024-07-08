<?php

namespace App\DTO\Request;
use App\DTO\Validator\DateIntervalValidator;
use App\Entity\Enum\Status;
use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Expression(
      "this.client || this.company",
      message:"Please, enter client or company!"
)]
class ProjectDto implements RequestDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    #[Assert\Length(
        min: 3,
        max: 120,
        minMessage: 'Title must be at least {{ limit }} characters long',
        maxMessage: 'Title cannot be longer than {{ limit }} characters',
    )]
    public string $title;

    #[Assert\Type("string")]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Title cannot be longer than {{ limit }} characters',
    )]
    public string|null $description = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [Status::class, 'values'], message: 'Choose a valid status["NOT_STARTED", "IN_PROGRESS", "PENDING", "ON_HOLD", "COMPLETED", "APPROVED"]')]
    public string $status;

    #[Assert\NotBlank]
    #[Assert\Callback([DateIntervalValidator::class, 'validate'])]
    public string $duration;

    #[Assert\Type("string")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Client be at least {{ limit }} characters long',
        maxMessage: 'Client cannot be longer than {{ limit }} characters',
    )]
    public string|null $client = null;

    #[Assert\Type("string")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Company must be at least {{ limit }} characters long',
        maxMessage: 'Company cannot be longer than {{ limit }} characters',
    )]
    public string|null $company = null;
}