<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\API\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\{Response, JsonResponse};
use App\Containers\UserSection\Users\DTO\Password as PasswordDTO;
use App\Containers\UserSection\Users\Actions\ChangeUserPasswordAction;
use App\Ship\Abstracts\Controllers\ApiController as AbstractController;
use App\Containers\UserSection\Users\UI\API\Requests\PasswordResetRequest;

class PasswordResetController extends AbstractController
{
    public function action(PasswordResetRequest $request): Response|JsonResponse
    {
        if ($request->wantsJson()) {
            $response = Password::reset(
                credentials: $request->getResetCredentials(),
                callback: function ($user, $password) {
                $dto = new PasswordDTO(password: $password);
                ChangeUserPasswordAction::new($dto, $user)->run();
            }
            );
            return $response === Password::PASSWORD_RESET
                ? $this->getSuccessResponse()
                : $this->getFailedResponse();
        }
        return $this->needAccept();
    }

    private function getSuccessResponse(): JsonResponse
    {
        return response()->json(
            [
                'status'   => true,
                'messages' => [
                    [
                        'field' => null,
                        'text'  => trans('partner::password.change.text'),
                    ],
                ],
            ]
        );
    }

    private function getFailedResponse(): JsonResponse
    {
        return response()->json(
            [
                'status'   => false,
                'messages' => [
                    [
                        'field' => null,
                        'text'  => trans('partner::password.fail_change.text'),
                    ],
                ],
            ]
        );
    }
}
