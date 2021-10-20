<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Services\Social;

use Error;
use App\Containers\UserSection\Users\Models\User;
use App\Containers\UserSection\Users\DTO\User as UserDTO;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Authentication\DTO\SocialUser;
use App\Containers\UserSection\Authentication\Models\SocialAccount;
use App\Containers\UserSection\Authentication\Mappers\SocialAccountMapper;
use App\Containers\UserSection\Authentication\Entities\SocialAccountEntity;
use App\Containers\UserSection\Authentication\Contracts\SocialAccountService;
use App\Containers\UserSection\Authentication\Repositories\SocialAccountRepository;

class SocialAccountServiceImp implements SocialAccountService
{
    public function __construct(
        private SocialAccountRepository $socialAccountRepository,
    )
    {
    }

    public function load(string $accountId): SocialAccountEntity
    {
        $accountOrmEntity = $this->socialAccountRepository->findByProviderId(
            (int) $accountId,
        );

        if (is_null($accountOrmEntity)) {
            throw new Error('Account not found');
        }

        return SocialAccountMapper::mapToDomain($accountOrmEntity, $accountOrmEntity->user);
    }

    public function update(string $accountId, SocialUser $dto): SocialAccountEntity
    {
        $accountOrmEntity = $this->socialAccountRepository->findByProviderId(
            (int) $accountId,
        );

        if (is_null($accountOrmEntity)) {
            throw new Error('Account not found');
        }

        $accountOrmEntity->update(attributes: $dto->toArray());

        return SocialAccountMapper::mapToDomain($accountOrmEntity, $accountOrmEntity->user);
    }

    /**
     * @throws UnknownProperties
     */
    public function create(SocialUser $dto): SocialAccountEntity
    {
        $userDto = new UserDTO(data: $dto);
        $userOrmEntity = User::create(
            [
                'name'              => $userDto->name,
                'email'             => $userDto->email,
                'password'          => $userDto->password,
            ]
        );
        $accountOrmEntity = SocialAccount::create(
            [
                'provider_id'      => $dto->provider_id,
                'nickname'         => $dto->nickname,
                'avatar'           => $dto->avatar,
                'token'            => $dto->token,
                'token_expires_at' => $dto->tokenExpiresAt,
                'refresh_token'    => $dto->refreshToken,
                'user_id'          => $userOrmEntity->id,
            ]
        );

        return SocialAccountMapper::mapToDomain($accountOrmEntity, $userOrmEntity);
    }
}
