<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateClient
{
    public function handle($request, $next)
    {
        if (!Auth::guard('clientes')->check()) { 
            return redirect()->route('client.login')->with('error', 'Debes iniciar sesión como cliente');
        }

        return $next($request);
    }
}