<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Contracts\UseCases;

interface LogoutUser
{
    public function logout(): bool;
}
