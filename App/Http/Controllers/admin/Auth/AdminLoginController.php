<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends \App\Http\Controllers\Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correoE' => 'required|email',
            'password' => 'required|string'
        ]);
    
        if (Auth::guard('administradores')->attempt($request->only('correoE', 'password'))) {
            return redirect()->intended(route('admin.dashboard'));
        }
    
        return back()->withErrors(['correoE' => 'Credenciales inválidas']);
    }
    public function logout(Request $request)
    {
        
        Session::forget('admin');
        return redirect()->route('admin.login');
    }
}