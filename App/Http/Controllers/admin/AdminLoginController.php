<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar formulario de login del administrador
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Procesar inicio de sesión del administrador
     */
    public function login(Request $request)
    {
        // Validación básica
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string'
        ]);

        // Buscar al administrador por correo
        $admin = Administrator::where('correoE', $request->input('correo'))->first();

        // Verificar credenciales y estado
        if (!$admin || !Hash::check($request->input('password'), $admin->password) || $admin->estado_administrador != 1) {
            return back()->withErrors(['login' => 'Credenciales incorrectas o cuenta inactiva']);
        }

        // Guardar datos en sesión
        Session::put('admin', [
            'id_administrador' => $admin->id_administrador,
            'nombres' => $admin->nombres,
            'apellidos' => $admin->apellidos,
            'correoE' => $admin->correoE,
            'n_identificacion' => $admin->n_identificacion,
            'id_rol_admin' => $admin->role->id_rol_admin,
            'nombre_rol' => $admin->role->nombre_rol,
            'permisos' => $admin->role->permisos ?? [] // Si los guardas como JSON o relación
        ]);

        // Redirigir al dashboard
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Cerrar sesión del administrador
     */
    public function logout(Request $request)
    {
        Session::forget('admin');

        return redirect()->route('admin.login');
    }
}
