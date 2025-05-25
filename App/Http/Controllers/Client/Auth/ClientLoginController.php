<?php
namespace App\Http\Controllers\Client\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientLoginController extends \App\Http\Controllers\Controller
{
public function showLoginForm()
{
return view('client.auth.login');
}

public function login(Request $request)
{
$request->validate([
'correoE' => 'required|email',
'password' => 'required|string'
]);

// Simular autenticación con base de datos
$cliente = \App\Models\admin\ClientesModel::where('correoE', $request->input('correoE'))->first();

if (!$cliente || !password_verify($request->input('password'), $cliente->password)) {
return back()->withErrors(['correoE' => 'Credenciales inválidas']);
}

Session::put('client', $cliente);

return redirect()->intended(route('home.index'));
}

public function logout(Request $request)
{
Session::forget('client');
return redirect()->route('home.index')->with('success', 'Sesión cerrada correctamente');
}
}