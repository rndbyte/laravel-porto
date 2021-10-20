<?php

return [
    'login'    => [
        'required' => 'Необходимо указать Email',
        'email'    => 'Необходимо указать Email',
        'exists'   => 'Email не зарегистрирован',
    ],
    'password' => [
        'required' => 'Необходимо указать пароль',
    ],
    'failed'   => 'Неверный логин или пароль',
    'success'  => 'Успешно авторизован',
];
