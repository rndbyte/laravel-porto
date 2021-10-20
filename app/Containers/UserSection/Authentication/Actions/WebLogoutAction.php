<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Actions;

use App\Ship\Contracts\Action;
use App\Containers\UserSection\Authentication\Contracts\UseCases\LogoutUser;

class WebLogoutAction implements Action
{
    public function __construct(
        private LogoutUser $logoutUserService,
    )
    {
    }

    /**
     * Try to logout current user.
     *
     * @return bool
     */
    public function run(): bool
    {
        return $this->logoutUserService->logout();
    }
}
