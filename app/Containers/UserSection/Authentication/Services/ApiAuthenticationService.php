<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Services;

use App\Containers\UserSection\Authentication\Contracts\Credentials;
use App\Containers\UserSection\Authentication\Contracts\UseCases\LoginUser;
use App\Containers\UserSection\Authentication\Contracts\UseCases\LogoutUser;

class ApiAuthenticationService implements LoginUser, LogoutUser
{
    public function attempt(Credentials $credentials): bool
    {
        // TODO: Implement attempt() method.
    }

    public function logout(): bool
    {
        // TODO: Implement logout() method.
    }
}
