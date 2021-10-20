<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Services;

use Illuminate\Support\Facades\{Auth, Session};
use App\Containers\UserSection\Authentication\DTO\WebCredentials;
use App\Containers\UserSection\Authentication\Contracts\Credentials;
use App\Containers\UserSection\Authentication\Contracts\UseCases\{LoginUser, LogoutUser};

class WebAuthenticationService implements LoginUser, LogoutUser
{
    public function attempt(Credentials|WebCredentials $credentials): bool
    {
        return Auth::attempt([
            'email' => $credentials->email,
            'password' => $credentials->password,
        ], $credentials->remember);
    }

    public function login(int $userId, bool $remember): bool
    {
        return (bool) Auth::loginUsingId($userId, $remember);
    }

    public function logout(): bool
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return true;
    }
}
