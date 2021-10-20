<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Actions;

use Throwable;
use App\Ship\Contracts\Action;
use App\Containers\UserSection\Authentication\Contracts\UseCases\LoginSocialUser;
use App\Containers\UserSection\Authentication\Contracts\{OAuthService, SocialAccountService};

class WebGithubLoginAction implements Action
{
    public function __construct(
        private OAuthService $githubService,
        private LoginSocialUser $loginSocialUserService,
        private SocialAccountService $socialAccountService,
    )
    {
    }

    public function run(): string
    {
        $socialDto = $this->githubService->getUser();

        // TODO rework this
//        try {
//            // if account not null update current account
//            $account = $this->socialAccountService->update($socialDto->provider_id, $socialDto);
//        } catch (Throwable $error) {
//            // if user data not found, create a new user
//            $account = $this->socialAccountService->create($socialDto);
//        }

        // login current user
//        $token = $this->loginSocialUserService->createToken($account->getAccount()->getId(), $socialDto->nickname);
//        $this->loginSocialUserService->login($account->getAccount()->getId(), false);
//        return $token;
    }
}
