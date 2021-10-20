<?php

namespace App\Containers\UserSection\Authentication\UI\API\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\{Request, Response, JsonResponse};
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Authentication\DTO\ApiCredentials;
use App\Ship\Abstracts\Controllers\ApiController as AbstractController;
use App\Containers\UserSection\Authentication\UI\API\Requests\LoginRequest;
use App\Containers\UserSection\Authentication\Actions\{ApiLoginAction, ApiLogoutAction};

class AuthenticationController extends AbstractController
{
    public function __construct(
        private ApiLogoutAction $logoutAction,
    )
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request): JsonResponse|Response
    {
        if (!$request->wantsJson()) {
            return $this->needAccept();
        }

        $credentials = new ApiCredentials(...$request->validated());

        if (app(ApiLoginAction::class, compact('credentials'))->run()) {
            $request->session()->regenerate();
            return response()->json([
                'status' => true,
                'message' => trans(key: 'authentication::login.success')
            ], JsonResponse::HTTP_OK);
        }

        throw new HttpResponseException(
            response()->json(
                [
                    'status'   => false,
                    'message' => trans(key: 'authentication::login.failed'),
                ],
                JsonResponse::HTTP_UNAUTHORIZED
            )
        );
    }

    public function logout(Request $request): JsonResponse
    {
        if (!$this->logoutAction->run()) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to logout. Something went wrong!'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out.'
        ], JsonResponse::HTTP_OK);
    }
}
