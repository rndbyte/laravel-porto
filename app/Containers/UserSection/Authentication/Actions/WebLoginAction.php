<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Actions;

use App\Ship\Contracts\Action;
use App\Containers\UserSection\Authentication\DTO\WebCredentials;
use App\Containers\UserSection\Authentication\Contracts\UseCases\LoginUser;

class WebLoginAction implements Action
{
    public function __construct(
        private WebCredentials $credentials,
        private LoginUser $loginUserService
    )
    {
    }

    public static function new(WebCredentials $credentials): self
    {
        return new self($credentials, resolve(LoginUser::class));
    }

    /**
     * Attempt to login user by provided credentials.
     *
     * @return bool
     */
    public function run(): bool
    {
        return $this->loginUserService->attempt($this->credentials);
    }
}
