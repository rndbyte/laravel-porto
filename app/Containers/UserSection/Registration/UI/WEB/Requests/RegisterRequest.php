<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Registration\UI\WEB\Requests;

use App\Ship\Abstracts\Requests\ApiRequest as AbstractRequest;

/**
 * @summary User registration and authentication
 * @description
 * <p>Register a new user and authenticates him</p>
 * <p><strong>Password min length:</strong></p>
 * <ul>
 *  <li>message: Password length at least 8 characters</li>
 *  <li>http code: 400</li>
 * </ul>
 * <p><strong>Password confirmed:</strong></>
 *  <ul>
 *  <li>message: Password mismatch</li>
 *  <li>http code: 400</li>
 * </ul>
 */
class RegisterRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => trans(key: 'auth::register.name.required'),
            'email.required'     => trans(key: 'auth::register.email.required'),
            'email.email'        => trans(key: 'auth::register.email.email'),
            'email.unique'       => trans(key: 'auth::register.email.unique'),
            'password.required'  => trans(key: 'auth::register.password.required'),
            'password.min'       => trans(key: 'auth::register.password.length'),
            'password.confirmed' => trans(key: 'auth::register.password.confirmed'),
        ];
    }
}
