<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\Repositories;

use App\Ship\Contracts\OrmModel;
use App\Containers\UserSection\Users\Models\User;
use App\Ship\Abstracts\Repositories\Repository as AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(private User $model)
    {
    }

    public static function static(): self
    {
        return new self(resolve(User::class));
    }

    public function findByLogin(string $login, array $columns = ['*']): User|OrmModel|null
    {
        return $this->builder()
            ->select($columns)
            ->where('email', $login)
            ->first();
    }
}
