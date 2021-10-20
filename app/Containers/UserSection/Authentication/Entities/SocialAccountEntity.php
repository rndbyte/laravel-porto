<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Entities;

use Illuminate\Support\Carbon;

class SocialAccountEntity
{
    public function __construct(
        private int $id, // provider_id
        private string $nickname,
        private string $avatar,
        private string $token,
        private string $refreshToken,
        private Carbon $tokenExpiresAt,
        private AccountEntity $account,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getAccount(): AccountEntity
    {
        return $this->account;
    }

    public function tokenExpiresAt(): Carbon
    {
        return $this->tokenExpiresAt;
    }
}
