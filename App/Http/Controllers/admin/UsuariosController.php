<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin\UsuariosModel;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protección de autenticación
    }

    // Vista de usuarios
    public function index()
    {
        return view('admin.usuarios.index', ['title' => 'Usuarios']);
    }

    // Listar usuarios activos
    public function listar()
    {
        $usuarios = UsuariosModel::where('estado', 1)->get();

        foreach ($usuarios as $usuario) {
            $usuario->accion = '<div class="d-flex">
                <button class="btn btn-primary" type="button" onclick="editUser(' . $usuario->id . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="eliminarUser(' . $usuario->id . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }

        return response()->json($usuarios);
    }

    // Registrar o actualizar usuario
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo,' . $request->id,
            'clave' => 'nullable|min:6'
        ]);

        $datos = $request->except('clave');
        if ($request->filled('clave')) {
            $datos['clave'] = Hash::make($request->clave);
        }

        if (!$request->id) {
            UsuariosModel::create($datos);
            return response()->json(['msg' => 'Usuario registrado', 'icono' => 'success']);
        }

        UsuariosModel::where('id', $request->id)->update($datos);
        return response()->json(['msg' => 'Usuario actualizado', 'icono' => 'success']);
    }

    // Eliminar usuario (desactivar)
    public function delete($idUser)
    {
        UsuariosModel::where('id', $idUser)->update(['estado' => 0]);
        return response()->json(['msg' => 'Usuario dado de baja', 'icono' => 'success']);
    }

    // Obtener usuario por ID
    public function edit($idUser)
    {
        return response()->json(UsuariosModel::find($idUser));
    }
}
