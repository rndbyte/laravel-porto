<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Contracts;

use App\Containers\UserSection\Authentication\DTO\SocialUser;
use App\Containers\UserSection\Authentication\Entities\SocialAccountEntity;

interface SocialAccountService
{
    public function create(SocialUser $dto): SocialAccountEntity;
    public function load(string $accountId): SocialAccountEntity;
    public function update(string $accountId, SocialUser $dto): SocialAccountEntity;
}
