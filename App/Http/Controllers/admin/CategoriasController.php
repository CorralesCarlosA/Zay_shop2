<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CategoriasModel;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protección de autenticación
    }

    // Mostrar vista de categorías
    public function index()
    {
        return view('admin.categorias.index', ['title' => 'Categorías']);
    }

    // Listar categorías activas en JSON
    public function listar()
    {
        $categorias = CategoriasModel::where('estado', 1)->get();

        foreach ($categorias as $categoria) {
            $categoria->accion = '<div class="d-flex">
                <button class="btn btn-primary" type="button" onclick="editCat(' . $categoria->id . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="eliminarCat(' . $categoria->id . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }

        return response()->json($categorias);
    }

    // Registrar o actualizar una categoría
    public function registrar(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255'
        ]);

        $categoria = $request->categoria;
        $id = $request->id;

        if (!$id) {
            $existe = CategoriasModel::where('categoria', $categoria)->where('estado', 1)->exists();
            if ($existe) {
                return response()->json(['msg' => 'La categoría ya existe', 'icono' => 'warning']);
            }
            CategoriasModel::create(['categoria' => $categoria, 'estado' => 1]);
            return response()->json(['msg' => 'Categoría registrada', 'icono' => 'success']);
        }

        $actualizado = CategoriasModel::where('id', $id)->update(['categoria' => $categoria]);
        return response()->json(['msg' => $actualizado ? 'Categoría modificada' : 'Error al modificar', 'icono' => $actualizado ? 'success' : 'error']);
    }

    // Eliminar (desactivar) una categoría
    public function delete($idCat)
    {
        if (!is_numeric($idCat)) {
            return response()->json(['msg' => 'Error desconocido', 'icono' => 'error']);
        }

        $eliminado = CategoriasModel::where('id', $idCat)->update(['estado' => 0]);
        return response()->json(['msg' => $eliminado ? 'Categoría dada de baja' : 'Error al eliminar', 'icono' => $eliminado ? 'success' : 'error']);
    }

    // Obtener una categoría por ID
    public function edit($idCat)
    {
        if (!is_numeric($idCat)) {
            return response()->json(['msg' => 'Error desconocido', 'icono' => 'error']);
        }

        $categoria = CategoriasModel::find($idCat);
        return response()->json($categoria);
    }
}
