<?php

return [
    'login'    => [
        'required' => 'Email is required',
        'email'    => 'Email is required',
        'exists'   => 'Email not registered',
    ],
    'password' => [
        'required' => 'Password is required',
    ],
    'failed'   => 'Wrong login or password',
    'success'  => 'Successfully authorized',
];
