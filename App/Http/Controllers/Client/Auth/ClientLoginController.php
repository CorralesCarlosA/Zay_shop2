<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Client; 


class ClientLoginController extends Controller
{
    /**
     * Mostrar formulario de inicio de sesión
     */
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    /**
     * Iniciar sesión del cliente
     */
    public function login(Request $request)
    {
        $request->validate([
            'correoE' => 'required|email',
            'password' => 'required|string'
        ]);
    
        $credentials = $request->only('correoE', 'password');
        
        // Verificar primero si el usuario existe
        $client = Client::where('correoE', $credentials['correoE'])->first();
        
        if (!$client) {
            return back()->withErrors(['correoE' => 'El correo no está registrado']);
        }
        
        // Verificar el estado del cliente
        if ($client->estado_cliente != 1) {
            return back()->withErrors(['correoE' => 'Tu cuenta está desactivada']);
        }
    
        if (Auth::guard('clientes')->attempt($credentials)) {
            return redirect()->intended(route('home.index'));
        }
    
        return back()->withErrors(['password' => 'Contraseña incorrecta']);
    }

    /**
     * Cerrar sesión del cliente
     */
    public function logout(Request $request)
    {
        Auth::guard('clientes')->logout(); // ✅ Bien usado

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login');
    }
}