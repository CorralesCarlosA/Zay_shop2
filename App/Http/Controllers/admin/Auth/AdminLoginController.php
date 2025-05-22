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
        $validated = $request->validate([
            'correoE' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Administrator::where('correoE', $request->input('correoE'))->first();

        if ($admin && Hash::check($request->input('password'), $admin->password)) {
            Session::put('admin', $admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Credenciales inválidas']);
    }

    public function logout(Request $request)
    {
        Session::forget('admin');
        return redirect()->route('admin.login');
    }
}
