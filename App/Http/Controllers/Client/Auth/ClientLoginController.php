<?php
namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientLoginController extends Controller
{
/**
* Mostrar formulario de login
*/
public function showLoginForm()
{
return view('client.auth.login');
}

/**
* Procesar inicio de sesión
*/
public function login(Request $request)
{
$request->validate([
'correoE' => 'required|email',
'password' => 'required|string',
]);

$cliente = Client::where('correoE', $request->input('correoE'))->first();

if (!$cliente || !Hash::check($request->input('password'), $cliente->password)) {
return back()->withErrors(['correoE' => 'Credenciales inválidas']);
}

if ($cliente->estado_cliente == 0) {
return back()->withErrors(['correoE' => 'Tu cuenta está inactiva. Contáctanos si necesitas ayuda']);
}

Session::put('client', $cliente);

return redirect()->intended(route('home.index'));
}

/**
* Cerrar sesión del cliente
*/
public function logout()
{
Session::forget('client');
return redirect()->route('home.index')->with('success', 'Sesión cerrada correctamente');
}
}