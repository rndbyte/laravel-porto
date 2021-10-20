<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Contracts\UseCases;

interface LoginSocialUser extends LoginUser
{
    public function createToken(int $userId, string $name): string;
}
