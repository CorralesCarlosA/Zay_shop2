<?php

namespace App\Http\Controllers\Client\Auth;

use Illuminate\Http\Request;
use App\Models\client\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientLoginController extends \App\Http\Controllers\Controller
{
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'correoE' => 'required|email',
            'password' => 'required'
        ]);

        $cliente = Client::where('correoE', $request->input('correoE'))->first();

        if ($cliente && Hash::check($request->input('password'), $cliente->password)) {
            Session::put('client', $cliente);
            return redirect()->route('client.dashboard');
        }

        return back()->withErrors(['error' => 'Correo o contraseña incorrecta']);
    }

    public function logout(Request $request)
    {
        Session::forget('client');
        return redirect()->route('client.login');
    }
}
