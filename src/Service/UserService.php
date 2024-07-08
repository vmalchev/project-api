<?php

namespace App\Service;

use App\DTO\IDto;
use App\DTO\Request\UserDto;
use App\DTO\Response\Mapper\UserResponseMapper;
use App\DTO\Response\UserResponseDto;
use App\Entity\User;
use App\Exception\UserException;
use App\Exception\UserExistsException;
use App\Factory\UserFactory;
use App\Repository\Contract\IUserRepository;


class UserService
{
    public function __construct(
        private UserFactory $userFactory,
        private IUserRepository $userRepository,
        private UserResponseMapper $userResponseMapper
    ) {}

    public function create(UserDto $userDto): UserResponseDto
    {
        $user = $this->userFactory->create($userDto);

        if (!is_null($this->userRepository->findByUsername($user->getUsername()))) {
            throw new UserExistsException("User with username '" . $user->getUsername() . "'' already exists!");
        }

        $this->userRepository->add($user);

        return $this->userResponseMapper->map($user);
    }
}