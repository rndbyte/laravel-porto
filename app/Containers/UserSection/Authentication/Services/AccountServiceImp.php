<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Services;

use App\Containers\UserSection\Users\DTO\User;
use App\Containers\UserSection\Authentication\Entities\AccountEntity;
use App\Containers\UserSection\Authentication\Contracts\AccountService;
use App\Containers\UserSection\Authentication\Repositories\AccountRepository;
use App\Containers\UserSection\Authentication\Exceptions\AccountNotFoundException;

class AccountServiceImp implements AccountService
{
    public function __construct(
        private AccountRepository $accountRepository,
    )
    {
    }

    /**
     * @throws AccountNotFoundException
     */
    public function load(int $accountId): AccountEntity
    {
        return $this->accountRepository->findById($accountId);
    }

    /**
     * @throws AccountNotFoundException
     */
    public function update(int $accountId, User $dto): AccountEntity
    {
        return $this->accountRepository->update($accountId, $dto);
    }
}
