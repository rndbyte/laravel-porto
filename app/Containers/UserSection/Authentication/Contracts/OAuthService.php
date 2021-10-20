<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Contracts;

use App\Containers\UserSection\Authentication\Entities\SocialAccountEntity;

interface OAuthService
{
    public function getOAuthUrl(): string;
    public function getUser(): SocialAccountEntity;
}
