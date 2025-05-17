<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Los URIs que deben excluirse de la verificación CSRF
     *
     * @var array<int, string>
     */
    protected $except = [
        // Ejemplo:
        'admin/login',
        'client/login',
        'api/*'
    ];
}
