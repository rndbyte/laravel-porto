<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Entities;

class AccountEntity
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $rememberToken,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }
}
