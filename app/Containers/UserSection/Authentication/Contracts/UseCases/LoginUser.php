<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Contracts\UseCases;

use App\Containers\UserSection\Authentication\Contracts\Credentials;

interface LoginUser
{
    public function attempt(Credentials $credentials): bool;
}
