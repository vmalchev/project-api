<?php

namespace App\DTO\Response;

class UserResponseDto
{
    public string $id;

    public string $username;

    public string|null $email = null;

    public \DateTimeInterface $createdAt;

    public \DateTimeInterface|null $updatedAt = null;

    /**
     * @param string $id
     * @param string $username
     * @param string|null $email
     * @param \DateTimeInterface $createdAt
     * @param \DateTimeInterface|null $updatedAt
     */
    public function __construct(string $id, string $username, ?string $email, \DateTimeInterface $createdAt, ?\DateTimeInterface $updatedAt)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}