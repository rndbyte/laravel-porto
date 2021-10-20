<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\API\Requests;

use App\Ship\Abstracts\Requests\ApiRequest as AbstractRequest;

/**
 * @summary User password reset request
 * @description
 * <p>To successfully complete the password reset procedure, you need to pass a password repeat field named password_confirmation</p>
 * <p><strong>Token failed:</strong></p>
 * <pre>
 * status: false
 * messages: [{
 *      field: null
 *      text: Token has expired or is invalid
 * }]
 * </pre>
 */
class PasswordResetRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email|exists:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required'     => [
                'field' => null,
                'text'  => trans(key: 'users::password.token.required'),
            ],
            'email.required'     => [
                'field' => 'email',
                'text'  => trans(key: 'users::password.email.required'),
            ],
            'email.email'        => [
                'field' => 'email',
                'text'  => trans(key: 'users::password.email.email'),
            ],
            'email.exists'       => [
                'field' => 'email',
                'text'  => trans(key: 'users::password.email.exists'),
            ],
            'password.required'  => [
                'field' => 'password',
                'text'  => trans(key: 'users::password.password.required'),
            ],
            'password.min'       => [
                'field' => 'password',
                'text'  => trans(key: 'users::password.password.min'),
            ],
            'password.confirmed' => [
                'field' => 'password',
                'text'  => trans(key: 'users::password.password.confirmed'),
            ],
        ];
    }

    public function getResetCredentials(): array
    {
        return $this->only(
            [
                'email',
                'password',
                'password_confirmation',
                'token',
            ]
        );
    }
}
