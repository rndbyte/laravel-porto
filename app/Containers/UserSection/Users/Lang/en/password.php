<?php

return [
    'token'       => [
        'required' => 'Missing token',
    ],
    'email'       => [
        'required' => 'Email is required',
        'email'    => 'Email is required',
        'exists'   => 'Email not registered',
    ],
    'password'    => [
        'required'  => 'Password required',
        'length'    => 'Password must be at least 8 characters long',
        'confirmed' => 'Password mismatch',
    ],
    'send'        => 'The letter has been sent to the specified Email',
    'fail'        => 'Password reset link was not sent!',
    'change'      => 'Password changed',
    'fail_change' => 'Token has expired or is invalid',
];
