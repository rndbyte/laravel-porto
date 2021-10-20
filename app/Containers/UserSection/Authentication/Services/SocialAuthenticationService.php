<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Services;

use App\Containers\UserSection\Users\Models\User;
use App\Containers\UserSection\Authentication\Contracts\UseCases\LoginSocialUser;

class SocialAuthenticationService extends WebAuthenticationService implements LoginSocialUser
{
    public function createToken(int $userId, string $name): string
    {
        return User::find($userId)->createToken($name)->plainTextToken;
    }
}
