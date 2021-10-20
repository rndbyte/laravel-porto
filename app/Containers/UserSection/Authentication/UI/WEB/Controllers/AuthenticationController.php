<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\UI\WEB\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View as ViewContract;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Authentication\DTO\WebCredentials;
use App\Ship\Abstracts\Controllers\Controller as AbstractController;
use App\Containers\UserSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\UserSection\Authentication\Actions\{WebLoginAction, WebLogoutAction};

class AuthenticationController extends AbstractController
{
    public function __construct(
        private WebLogoutAction $logoutAction,
    )
    {
    }

    public function index(Request $request): ViewContract
    {
        return View::make('authentication::login');
    }

    /**
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = new WebCredentials(...$request->validated());

        if (app(WebLoginAction::class, compact('credentials'))->run()) {
            $request->session()->regenerate();

            $redirect = $request->wantsJson() ?
                redirect()->to(route('login.status')) :
                redirect()->intended();

            return $redirect->with([
                'auth' => [
                    'status'  => true,
                    'message' => trans(key: 'authentication::login.success')
                ]
            ]);
        }

        $redirect = $request->wantsJson() ?
            redirect()->to(route('login.status')) :
            back();

        return $redirect->with([
            'auth' => [
                'status'  => false,
                'message' => trans(key: 'authentication::login.failed'),
            ]
        ]);
    }

    public function status(Request $request)
    {
        if ($request->session()->has('auth')) {
            return $request->session()->get('auth');
        }

        return $request->session()->get('errors');
    }

    public function logout(Request $request): RedirectResponse
    {
        if (!$this->logoutAction->run()) {
            abort(
                RedirectResponse::HTTP_INTERNAL_SERVER_ERROR,
                'Unable to logout. Something went wrong!',
            );
        }

        return redirect()->route('login');
    }
}
