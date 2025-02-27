<?php

return [
    'auth' => [
        'user-registered' => [
            'email-exist' => 'Пользователь с таким email уже существует!',
        ],
        'user-logging' => [
            'invalid-credentials' => 'Неверные учетные данные!',
        ],
        'user-logout' => [
            'error' => 'Что-то пошло не так, попробуй-те позже!',
        ],
        'reset-password-form' => [
            'token-error' => 'Недействительный или устаревший токен',
            'password-error' => 'Ошибка сброса пароля.',
        ],
        'forgot-password-form' => [
            'user-not-found' => 'Пользователь с таким email не найден!',
        ],
    ],
    'products' => [
        'not-found' => 'Продукт не найден!',
    ],
    'user' => [
        'profile-update' => [
            'general' => 'An error occurred while updating your profile. Please try again later.',
            'error' => 'There was a problem updating your profile. Please try again.',
        ]
    ]
];
