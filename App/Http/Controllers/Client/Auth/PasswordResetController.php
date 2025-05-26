<?php

namespace App\Http\Controllers\Client\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\admin\Client;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Mostrar formulario para solicitar restablecimiento
     */
    public function showEmailForm()
    {
        return view('client.auth.passwords.email');
    }

    /**
     * Enviar token al correo del cliente
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'correoE' => 'required|email'
        ]);

        $cliente = Client::where('correoE', $request->input('correoE'))->first();

        if (!$cliente) {
            return back()->withErrors(['correoE' => 'Correo no encontrado']);
        }

        // Generar token único
        $token = Str::random(60);

        // Guardar en sesión o en base de datos (ejemplo simple)
        Session::put('password_reset_token', $token);
        Session::put('password_reset_email', $cliente->correoE);

        // Aquí iría el envío por correo real
        // Mail::to($cliente->correoE)->send(new ResetPasswordMail($token));

        return redirect()->route('client.password.reset', ['token' => $token]);
    }

    /**
     * Mostrar formulario para nueva contraseña
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        if (!$email || !$token) {
            return redirect()->route('client.password.email')
                ->withErrors(['error' => 'Token o correo inválido']);
        }

        return view('client.auth.passwords.reset', compact('token', 'email'));
    }

    /**
     * Actualizar contraseña del cliente
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'correoE' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:8|confirmed'
        ]);

        $cliente = Client::where('correoE', $request->input('correoE'))->first();

        if (!$cliente || $request->input('token') !== Session::get('password_reset_token')) {
            return back()->withErrors(['token' => 'Token inválido o expirado']);
        }

        // Actualizar contraseña
        $cliente->password = Hash::make($request->input('password'));
        $cliente->save();

        // Limpiar sesión
        Session::forget(['password_reset_token', 'password_reset_email']);

        return redirect()->route('client.login')->with('success', 'Contraseña actualizada correctamente');
    }
}