<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Client; 
use Illuminate\Validation\ValidationException;


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
    try {
        // Validar los datos con mensajes personalizados
        $validated = $request->validate([
            'correoE' => 'required|email',
            'password' => 'required|string'
        ], [
            'correoE.required' => 'El campo correo electrónico es obligatorio.',
            'correoE.email' => 'Debe ingresar un correo válido.',
            'password.required' => 'La contraseña es obligatoria.'
        ]);
    } catch (ValidationException $e) {
        // Capturar errores y devolver JSON con mensajes en español
        return response()->json([
            'status' => 'error',
            'message' => 'Error en la validación.',
            'errors' => $e->errors()
        ], 422);
    }

    // Intentar encontrar al cliente
    $client = Client::where('correoE', $validated['correoE'])->first();

    if (!$client) {
        return response()->json([
            'status' => 'error',
            'message' => 'El correo no está registrado.',
            'errors' => ['correoE' => ['El correo no está registrado.']]
        ], 422);
    }

    // Verificar estado del cliente
    if ($client->estado_cliente != 1) {
        return response()->json([
            'status' => 'error',
            'message' => 'Tu cuenta está desactivada.',
            'errors' => ['correoE' => ['Tu cuenta está desactivada.']]
        ], 422);
    }

    // Intentar autenticación
    if (Auth::guard('clientes')->attempt(['correoE' => $validated['correoE'], 'password' => $validated['password']])) {
        return response()->json([
            'status' => 'success',
            'message' => '¡Inicio de sesión exitoso! Redirigiendo...',
            'redirect' => route('home.index') // Devuelve la ruta del home
        ]);
    }

    // Error si la contraseña es incorrecta
    return response()->json([
        'status' => 'error',
        'message' => 'Contraseña incorrecta.',
        'errors' => ['password' => ['La contraseña ingresada es incorrecta.']]
        
    ], 422);
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


       /* public function login(Request $request)
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
    }*/
}