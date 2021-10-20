<?php

return [
    'name'     => [
        'required' => 'Необходимо указать имя',
    ],
    'email'    => [
        'required' => 'Необходимо указать Email',
        'email'    => 'Необходимо указать Email',
        'unique'   => 'Email уже зарегистрирован',
    ],
    'password' => [
        'required'  => 'Необходимо указать пароль',
        'length'    => 'Длина пароля не менее 8 символов',
        'confirmed' => 'Пароли не совпадают',
    ],
];