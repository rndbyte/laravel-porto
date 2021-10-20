<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\UI\WEB\Requests;

use App\Ship\Abstracts\Requests\Request;

class LoginRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => trans(key: 'authentication::login.login.required'),
            'email.email' => trans(key: 'authentication::login.login.email'),
            'password.required' => trans(key: 'authentication::login.password.required'),
        ];
    }
}
