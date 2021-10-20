<?php

return [
    'token'       => [
        'required' => 'Отсутствует токен',
    ],
    'email'       => [
        'required' => 'Необходимо указать Email',
        'email'    => 'Необходимо указать Email',
        'exists'   => 'Email не зарегистрирован',
    ],
    'password'    => [
        'required'  => 'Необходимо указать пароль',
        'length'    => 'Длина пароля должна быть не менее 8 символов',
        'confirmed' => 'Пароли не совпадают',
    ],
    'send'        => 'Письмо отправлено на указанный Email',
    'fail'        => 'Ссылка на сброс пароля не была отправлена!',
    'change'      => 'Пароль изменен',
    'fail_change' => 'Токен устарел или неверен',
];
