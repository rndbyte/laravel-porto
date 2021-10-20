<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\API\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\{Response, JsonResponse};
use App\Ship\Abstracts\Controllers\ApiController as AbstractController;
use App\Containers\UserSection\Users\UI\API\Requests\PasswordForgotRequest;

class PasswordForgotController extends AbstractController
{
    public function action(PasswordForgotRequest $request): Response|JsonResponse
    {
        if ($request->wantsJson()) {
            $response = Password::sendResetLink(
                credentials: $request->only('email')
            );
            return $response === Password::RESET_LINK_SENT
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
                        'text'  => trans('partner::password.send.text'),
                        'code'  => trans('partner::password.send.code'),
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
                        'text'  => trans('partner::password.fail.text'),
                        'code'  => trans('partner::password.fail.code'),
                    ],
                ],
            ]
        );
    }
}
