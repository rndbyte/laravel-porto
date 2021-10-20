<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Actions;

use App\Ship\Contracts\Action;
use App\Containers\UserSection\Authentication\Contracts\OAuthService;

class GithubGetTargetUrlAction implements Action
{
    public function __construct(
        private OAuthService $githubService,
    )
    {
    }

    public function run(): string
    {
        return $this->githubService->getOAuthUrl();
    }
}
