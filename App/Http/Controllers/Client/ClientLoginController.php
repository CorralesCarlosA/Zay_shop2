<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client\Client;

class ClientLoginController extends Controller
{
    /**
     * Mostrar formulario de inicio de sesión del cliente
     */
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    /**
     * Procesar el inicio de sesión del cliente
     */
    public function login(Request $request)
    {
        // Validación básica
        $request->validate([
            'n_identificacion' => 'required|string|size:6',
            'password' => 'required|string|min:6'
        ]);

        // Buscar al cliente
        $cliente = Client::where('n_identificacion', $request->input('n_identificacion'))->first();

        if (!$cliente || !hash_equals($cliente->password, md5($request->input('password')))) {
            return back()->withErrors(['login' => 'Credenciales incorrectas']);
        }

        // Guardar cliente en sesión
        $request->session()->put('cliente_id', $cliente->n_identificacion);
        $request->session()->put('cliente_tipo', $cliente->tipo_cliente);

        return redirect()->route('client.dashboard');
    }

    /**
     * Cerrar sesión del cliente
     */
    public function logout(Request $request)
    {
        $request->session()->forget('cliente_id');
        $request->session()->forget('cliente_tipo');

        return redirect()->route('client.login');
    }
}