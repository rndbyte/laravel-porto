<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Repositories;

use App\Ship\Contracts\OrmModel;
use App\Ship\Abstracts\Repositories\Repository;
use App\Containers\UserSection\Authentication\Models\SocialAccount;

class SocialAccountRepository extends Repository
{
    public function __construct(protected SocialAccount $model)
    {
    }

    public static function static(): self
    {
        return new self(resolve(SocialAccount::class));
    }

    public function findByNickName(string $nickname, array $columns = ['*']): SocialAccount|OrmModel|null
    {
        return $this->builder()
            ->select($columns)
            ->where('nickname', $nickname)
            ->first();
    }

    public function findByProviderId(int $id, array $columns = ['*']): SocialAccount|OrmModel|null
    {
        return $this->builder()
            ->select($columns)
            ->where('provider_id', $id)
            ->first();
    }
}
