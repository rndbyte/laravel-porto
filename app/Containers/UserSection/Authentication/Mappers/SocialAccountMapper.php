<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Mappers;

use App\Containers\UserSection\Users\Models\User;
use App\Containers\UserSection\Authentication\Models\SocialAccount;
use App\Containers\UserSection\Authentication\Entities\SocialAccountEntity;

class SocialAccountMapper
{
    public static function mapToDomain(SocialAccount $account, User $user): SocialAccountEntity
    {
        $accountEntity = AccountMapper::mapToDomain($user);

        return new SocialAccountEntity(
            $account->provider_id,
            $account->nickname,
            $account->avatar,
            $account->token,
            $account->refresh_token,
            $account->token_expires_at,
            $accountEntity,
        );
    }

//    public static function mapToOrm(AccountEntity $account): SocialAccount
//    {
//        $accountOrmEntity = new SocialAccount();
//        $accountOrmEntity->provider_id = $account->getId();
//        $accountOrmEntity->
//    }
}
