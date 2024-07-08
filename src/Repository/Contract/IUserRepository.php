<?php

namespace App\Repository\Contract;

use App\Entity\User;

interface IUserRepository
{
    /**
     * @param User $user
     * @return void
     */
    public function add(User $user): void;

    /**
     * @param User $user
     * @return void
     */
    public function remove(User $user): void;

    public function findById(int $id): ?User;

    public function findByUsername(string $username): ?User;

    public function flush(): void;
}