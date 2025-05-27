<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if ((Session::has('admin')) === false) {
            return redirect()->route('admin.login')->with('error', 'Acceso denegado. Debes iniciar sesión como administrador.');
        }
        // return $next($request);rutas antes de las modificacionesrutas antes de las modificaciones

        // Verificación adicional d`e seguridad
        if ($request->session()->get('admin.ip') !== $request->ip()) {
            Session::forget('admin');
            return redirect()->route('admin.login')
                   ->with('error', 'Sesión inválida desde otra IP');
        }

        return $next($request);
    }
}