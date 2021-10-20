<?php

return [
    'name'     => [
        'required' => 'Name is required',
    ],
    'email'    => [
        'required' => 'Email is required',
        'email'    => 'Email is required',
        'unique'   => 'Email already registered',
    ],
    'password' => [
        'required'  => 'Password is required',
        'length'    => 'Password length at least 8 characters',
        'confirmed' => 'Password mismatch',
    ],
];
