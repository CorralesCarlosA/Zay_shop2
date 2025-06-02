<?php

return [
'defaults' => [
'guard' => 'web',
'passwords' => 'users',
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'clientes' => [
        'driver'   => 'session',
        'provider' => 'clientes',
    ],

// Guard para administrador
'administradores' => [
    'driver' => 'session',
    'provider' => 'administradores'
],


// Guard para cliente – Bien usado
'clientes' => [
'driver' => 'session',
'provider' => 'clientes',
],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
        'clientes' => [
        'driver' => 'eloquent',
        'model'  => App\Models\admin\Client::class,
    ],

'administradores' => [
    'driver' => 'eloquent',
    'model' => App\Models\admin\Administrator::class,
],



],

'passwords' => [
'clientes' => [
'provider' => 'clientes',
'email' => 'client.auth.passwords.email',
'table' => 'password_reset_tokens',
'expire' => 60,
'throttle' => 10,
],
],
];