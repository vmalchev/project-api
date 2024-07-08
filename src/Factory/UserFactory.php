<?php

namespace App\Factory;

use App\DTO\Request\UserDto;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    /**
     * @param User $user
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(private User $user, private UserPasswordHasherInterface $passwordHasher)
    {}

    public function create(UserDto $userDto): User
    {
        return $this->user
            ->setUsername($userDto->username)
            ->setPassword($this->passwordHasher->hashPassword($this->user, $userDto->password))
            ->setEmail($userDto->email);

    }
}