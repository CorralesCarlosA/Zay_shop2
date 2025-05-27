<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends \App\Http\Controllers\Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $admin = Administrator::where('correoE', $credentials['email'])->first();

    if ($admin && Hash::check($credentials['password'], $admin->password)) {
        // Regenerar completamente la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        $request->session()->put('admin', [
            'id' => $admin->id_administrador,
            'email' => $admin->correoE,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'last_activity' => now()
        ]);
        
        return redirect()->intended(route('admin.dashboard'))
               ->with('success', 'Bienvenido al panel de administración');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas',
    ])->onlyInput('email');
}
    public function logout(Request $request)
    {
        
        Session::forget('admin');
        return redirect()->route('admin.login');
    }
}