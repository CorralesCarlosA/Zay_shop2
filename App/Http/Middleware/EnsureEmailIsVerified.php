<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el cliente está autenticado y si su correo fue verificado
        if (!$request->session()->has('cliente')) {
            return redirect()->route('client.login');
        }

        $cliente = $request->session()->get('cliente');

        // Asegúrate de que el modelo Client tenga el campo 'email_verified_at'
        if (is_null($cliente['email_verified_at'])) {
            return redirect()->route('client.verify-email');
        }

        return $next($request);
    }
}
