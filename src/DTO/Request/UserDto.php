<?php

namespace App\DTO\Request;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserDto implements RequestDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Type("string")]
    #[Assert\Length(
        min: 3,
        max: 25,
        minMessage: 'Username must be at least {{ limit }} characters long',
        maxMessage: 'Username cannot be longer than {{ limit }} characters',
    )]
    public string|null $username;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Type("string")]
    #[Assert\Length(
        min: 6,
        max: 50,
        minMessage: 'Password must be at least {{ limit }} characters long',
        maxMessage: 'Password cannot be longer than {{ limit }} characters',
    )]
    public string|null $password;

    #[Assert\Type("string")]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    public ?string $email = null;
}