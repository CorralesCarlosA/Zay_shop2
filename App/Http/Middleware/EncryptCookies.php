<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * Las cookies que deben excluirse de la encriptación
     *
     * @var array
     */
    protected $except = [
        // Puedes dejar vacío o poner ciertas cookies que no deban encriptarse
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, $next)
    {
        return parent::handle($request, $next);
    }
}
