<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Services\Social;

use TypeError;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Contracts\Provider;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Authentication\DTO\SocialUser;
use Laravel\Socialite\Contracts\User as SocialiteUserInterface;
use App\Containers\UserSection\Authentication\Contracts\OAuthService;
use App\Containers\UserSection\Authentication\Entities\AccountEntity;
use App\Containers\UserSection\Authentication\Entities\SocialAccountEntity;

class GithubService implements OAuthService
{
    public function getOAuthUrl(): string
    {
        return $this->getProvider()->stateless()->redirect()->getTargetUrl();
    }

    public function getUser(): SocialAccountEntity
    {
        $user = $this->getProvider()->stateless()->user();

        if ($user instanceof SocialiteUserInterface) {
            return new SocialAccountEntity(
                id: (int) $user->getId(),
                nickname: $user->getNickname(),
                avatar: $user->getAvatar(),
                token: $user->token,
                refreshToken: $user->refreshToken ?? '',
                tokenExpiresAt: Carbon::createFromTimestamp(now()->timestamp + (int)$user->expiresIn),
                account: new AccountEntity(
                    name: $user->name ?? '',
                    email: $user->email ?? '',
                    rememberToken: '',
                ),
            );
        } else {
            throw new TypeError('Expected Laravel\Socialite\Contracts\User, ' . gettype($user) . 'given.');
        }
    }

    private function getProvider(): Provider|GithubProvider
    {
        return Socialite::driver('github');
    }
}
