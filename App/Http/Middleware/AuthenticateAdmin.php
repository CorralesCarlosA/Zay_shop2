<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle($request, Closure $next, $guard = 'administradores')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login')->with('error', 'Acceso denegado. Inicia sesión como administrador.');
        }
    
        return $next($request);
    }
}