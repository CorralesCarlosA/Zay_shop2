<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\admin\Administrator;
use App\Models\admin\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminRegisterController extends \App\Http\Controllers\Controller
{
    public function showRegistrationForm()
    {
        $roles = AdminRole::all();
        return view('admin.auth.register', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'correoE' => 'required|email|unique:administradores,correoE',
            'password' => 'required|min:6|confirmed',
            'id_rol_admin' => 'required|int|exists:roles_administradores,id_rol_admin',
        ]);

        Administrator::create([
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'correoE' => $request->input('correoE'),
            'password' => Hash::make($request->input('password')),
            'id_rol_admin' => $request->input('id_rol_admin')
        ]);

        return redirect()->route('admin.login')->with('success', 'Administrador creado correctamente');
    }
}
