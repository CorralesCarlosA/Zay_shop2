<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareErrorsFromSession
{
    public function handle(Request $request, Closure $next): Response
    {
        // Aquí puedes compartir errores desde sesión a vista
        $errors = session('errors', null);

        view()->share('errors', $errors);

        return $next($request);
    }
}
