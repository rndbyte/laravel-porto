<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Actions;

use App\Ship\Contracts\Action;
use App\Containers\UserSection\Users\Models\User;

class AssignUserToRoleAction implements Action
{
    public function __construct(
        private User $user,
        private array $roles,
    )
    {
    }

    public static function new(User $user, array $roles): self
    {
        return new self($user, $roles);
    }

    public function run(): User
    {
        return $this->user->assignRole($this->roles);
    }
}
