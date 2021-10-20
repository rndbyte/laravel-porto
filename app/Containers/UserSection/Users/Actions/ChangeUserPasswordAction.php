<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Ship\Contracts\{Action, OrmModel};
use App\Containers\UserSection\Users\Models\User;
use App\Containers\UserSection\Users\DTO\Password;

/**
 * Class PasswordChange
 * @package App\Containers\Users\Actions
 */
class ChangeUserPasswordAction implements Action
{
    public function __construct(
        private Password $data,
        private User $model,
    )
    {
    }

    public static function new(Password $data, User $user): self
    {
        return new self($data, $user);
    }

    public function run(): User|Model|OrmModel
    {
        $this->model->password = $this->data->password;
        $this->model->setRememberToken($this->data->rememberToken);
        $this->model->save();
        return $this->model;
    }
}
