<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correoE' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('correoE', 'password');

        if (Auth::guard('administradores')->attempt($credentials)) { 
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['correoE' => 'Credenciales inválidas']);
    }

    public function logout(Request $request)
    {
        Auth::guard('administradores')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }
}