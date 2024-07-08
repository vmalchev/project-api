<?php

namespace App\DTO\Response\Mapper;

use App\DTO\Response\UserResponseDto;
use App\Entity\User;

class UserResponseMapper
{
    public function map(User $user): UserResponseDto
    {
        return new UserResponseDto(
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
            $user->getCreatedAt(),
            $user->getUpdatedAt()
        );
    }
}