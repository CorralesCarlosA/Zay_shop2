<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\admin\Client;

class PasswordResetController extends Controller
{
    /**
     * Mostrar formulario para recuperar contraseña
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
        $request->validate(['correoE' => 'required|email']);

        $cliente = Client::where('correoE', $request->input('correoE'))->first();

        if (!$cliente) {
            return back()->withErrors(['correoE' => 'No se encontró ningún cliente']);
        }

        // Generar token único
        $token = Str::random(60);

        // Guardarlo en password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $cliente->correoE],
            ['token' => $token, 'created_at' => now()]
        );

        // Aquí iría el envío real del correo
        // Mail::to($cliente->correoE)->send(new ResetPasswordMail($token));

        // Redirigir con mensaje de éxito
        return redirect()->route('client.login')->with('success', 'Hemos enviado instrucciones a tu correo.');
    }

    /**
     * Mostrar formulario para restablecer contraseña
     */
    public function showResetForm(Request $request, $token)
    {
        // Buscar el token en la tabla
        $resetToken = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$resetToken || now()->diffInMinutes($resetToken->created_at) > 15) {
            return redirect()->route('client.password.email')
                ->withErrors(['error' => 'El token es inválido o ha expirado']);
        }

        $email = $resetToken->email;

        return view('client.auth.passwords.reset', compact('token', 'email'));
    }

    /**
     * Restablecer contraseña desde token
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'correoE' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:8|confirmed'
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where([
                ['email', $request->input('correoE')],
                ['token', $request->input('token')]
            ])->first();

        if (!$tokenData) {
            return back()->withErrors(['token' => 'El token no es válido']);
        }

        $cliente = Client::where('correoE', $request->input('correoE'))->first();
        $cliente->password = bcrypt($request->input('password'));
        $cliente->save();

        // Eliminar token usado
        DB::table('password_reset_tokens')->where('email', $cliente->correoE)->delete();

        return redirect()->route('client.login')->with('success', 'Contraseña actualizada correctamente');
    }
}