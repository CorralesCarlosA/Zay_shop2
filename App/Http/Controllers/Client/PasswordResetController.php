<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;

class PasswordResetController extends Controller
{
/**
* Mostrar formulario para recuperar contraseña
*/
public function showEmailForm()
{
return view('admin.auth.passwords.email');
}

/**
* Enviar token al correo del administrador
*/
public function sendResetLink(Request $request)
{
$request->validate(['correoE' => 'required|email']);

$response = Password::broker('administradores')->sendResetLink(
$request->only('correoE')
);

return $response === \Illuminate\Auth\Passwords\PasswordBroker::RESET_LINK_SENT
? back()->with('status', __($response))
: back()->withErrors(['correoE' => __($response)]);
}

/**
* Mostrar formulario para restablecer contraseña
*/
public function showResetForm($token)
{
return view('admin.auth.passwords.reset', ['token' => $token]);
}

/**
* Guardar nueva contraseña
*/
public function resetPassword(Request $request)
{
$request->validate([
'correoE' => 'required|email',
'password' => 'required|min:8|confirmed',
'token' => 'required'
]);

$response = Password::broker('administradores')->reset(
$request->only('correoE', 'password', 'password_confirmation', 'token'),
function ($user, $password) {
$user->forceFill([
'password' => bcrypt($password)
])->save();
}
);

return $response == \Illuminate\Auth\Passwords\PasswordBroker::PASSWORD_RESET
? redirect()->route('admin.login')->with('status', __($response))
: back()->withErrors(['correoE' => [__($response)]]);
}
}