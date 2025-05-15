<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\PedidosModel;
use App\Models\admin\UsuariosModel;
use App\Models\admin\ProductosModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'validar', 'salir']);
    }

    // Página de inicio de sesión
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.login', ['title' => 'Acceso al sistema']);
    }

    // Validar credenciales de usuario
    public function validar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'clave' => 'required'
        ]);

        $usuario = UsuariosModel::where('correo', $request->email)->first();

        if (!$usuario || !password_verify($request->clave, $usuario->clave)) {
            return response()->json(['msg' => 'Credenciales incorrectas', 'icono' => 'warning']);
        }

        Auth::login($usuario);
        return response()->json(['msg' => 'Ingreso exitoso', 'icono' => 'success']);
    }

    // Dashboard de administración
    public function home()
    {
        $pendientes = PedidosModel::where('proceso', 1)->count();
        $procesos = PedidosModel::where('proceso', 2)->count();
        $finalizados = PedidosModel::where('proceso', 3)->count();
        $productos = ProductosModel::where('estado', 1)->count();

        return view('admin.administracion', compact('pendientes', 'procesos', 'finalizados', 'productos'));
    }

    // Obtener productos con cantidades mínimas
    public function productosMinimos()
    {
        $productos = ProductosModel::where('cantidad', '<', 15)->where('estado', 1)->orderBy('cantidad', 'DESC')->limit(3)->get();
        return response()->json($productos);
    }

    // Obtener los productos más vendidos
    public function topProductos()
    {
        $productos = ProductosModel::selectRaw('producto, SUM(cantidad) AS total')
            ->groupBy('id')
            ->orderBy('total', 'DESC')
            ->limit(3)
            ->get();

        return response()->json($productos);
    }

    // Cerrar sesión y redirigir al login
    public function salir()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
