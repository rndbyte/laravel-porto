<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\API\Requests;

use App\Ship\Abstracts\Requests\ApiRequest as AbstractRequest;

/**
 * @summary User password recovery request
 * @description
 * <p>No description</p>
 */
class PasswordForgotRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => [
                'field' => 'email',
                'text'  => trans(key: 'users::password.email.required'),
            ],
            'email.email'    => [
                'field' => 'email',
                'text'  => trans(key: 'users::password.email.email'),
            ],
            'email.exists'   => [
                'field' => 'email',
                'text'  => trans(key: 'users::password.email.exists'),
            ],
        ];
    }
}
