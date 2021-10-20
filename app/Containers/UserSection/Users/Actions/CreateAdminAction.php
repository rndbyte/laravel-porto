<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\Actions;

use App\Ship\Contracts\Action;
use App\Containers\UserSection\Users\Models\User;
use App\Containers\UserSection\Users\DTO\User as UserDTO;
use App\Containers\UserSection\Authorization\Actions\AssignUserToRoleAction;

class CreateAdminAction implements Action
{
    public function __construct(private UserDTO $data)
    {
    }

    public static function new(UserDTO $data): self
    {
        return new self($data);
    }

    public function run(): User
    {
        $admin = User::create([
            'name' => $this->data->name,
            'email' => $this->data->email,
            'password' => $this->data->password,
            'remember_token' => $this->data->rememberToken,
            'is_admin' => true,
        ]);

        return AssignUserToRoleAction::new($admin, ['admin'])->run();
    }
}
