<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Mappers;

use App\Containers\UserSection\Users\Models\User;
use App\Containers\UserSection\Authentication\Entities\AccountEntity;

class AccountMapper
{
    public static function mapToDomain(User $accountOrmEntity): AccountEntity
    {
        return new AccountEntity(
            $accountOrmEntity->id,
            $accountOrmEntity->name ?? '',
            $accountOrmEntity->email,
            $accountOrmEntity->remember_token ?? '',
        );
    }

//    public static function mapToOrm(AccountEntity $accountEntity): User
//    {
//        return new User([]);
//    }
}
