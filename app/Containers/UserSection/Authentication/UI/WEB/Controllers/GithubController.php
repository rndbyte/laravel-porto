<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\UI\WEB\Controllers;

use App\Ship\Abstracts\Controllers\Controller as AbstractController;
use Illuminate\Http\{Request, Response, JsonResponse, RedirectResponse};
use App\Containers\UserSection\Authentication\UI\WEB\Requests\OAuthRequest;
use App\Containers\UserSection\Authentication\Actions\{WebGithubLoginAction, GithubGetTargetUrlAction};

class GithubController extends AbstractController
{
    public function __construct(
        private WebGithubLoginAction $loginAction,
        private GithubGetTargetUrlAction $getTargetUrlAction,
    ) {
    }

    public function oauth(OAuthRequest $request): JsonResponse | RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'status' => true,
                    'src'    => $this->getTargetUrlAction->run(),
                ]
            );
        }
        return redirect()->to(env('FRONT_REDIRECT_BASE_URL'));
    }

    public function auth(Request $request): RedirectResponse
    {
        $token = $this->loginAction->run();
        return $this->redirectAfter(token: $token);
//        return redirect()->to(env('FRONT_REDIRECT_BASE_URL'));
    }

    private function redirectAfterCreate(string $token): RedirectResponse
    {
        return redirect()
            ->to(
                path: sprintf('%s?access_token=%s', env('FRONT_REDIRECT_AFTER_CREATED_USER'), $token),
                status: Response::HTTP_FOUND,
            );
    }

    private function redirectAfter(string $token): RedirectResponse
    {
        return redirect()
            ->to(
                path: sprintf('%s?access_token=%s', env('FRONT_REDIRECT_AFTER_LOGGING_USER'), $token),
                status: Response::HTTP_FOUND,
            );
    }
}
