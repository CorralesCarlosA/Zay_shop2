<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminLoginController extends BaseController
{
    /**
     * Muestra el formulario de inicio de sesión del admin
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Procesa el inicio de sesión del admin
     */
    public function login(Request $request)
    {
        // Validación básica
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        // Buscar al administrador
        $admin = Administrator::where('correoE', $request->input('correo'))->first();

        // Verificar credenciales
        if (!$admin || !hash_equals($admin->password, md5($request->input('password')))) {
            return back()->withErrors(['login' => 'Credenciales incorrectas']);
        }

        // Guardar datos del admin en sesión
        $request->session()->put('admin', [
            'id_administrador' => $admin->id_administrador,
            'nombres' => $admin->nombres,
            'apellidos' => $admin->apellidos,
            'correoE' => $admin->correoE,
            'n_identificacion' => $admin->n_identificacion,
            'role' => $admin->role->nombre_rol,
            'permisos' => $admin->role->permisos ?? [],
        ]);

        // Redirigir al dashboard
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Cierra la sesión del administrador
     */
    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin',
            'admin_id',
            'admin_role',
            'admin_permisos'
        ]);

        return redirect()->route('admin.login');
    }
}
