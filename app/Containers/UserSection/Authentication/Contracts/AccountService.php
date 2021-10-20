<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Contracts;

use App\Containers\UserSection\Users\DTO\User;
use App\Containers\UserSection\Authentication\Entities\AccountEntity;

interface AccountService
{
    public function load(int $accountId): AccountEntity;
    public function update(int $accountId, User $dto): AccountEntity;
}
