<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\CategoriasModel;
use App\Models\admin\ProductosModel;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protección de autenticación
    }

    // Vista de productos
    public function index()
    {
        $categorias = CategoriasModel::where('estado', 1)->get();
        return view('admin.productos.index', compact('categorias'));
    }

    // Listar productos activos
    public function listar()
    {
        $productos = ProductosModel::where('estado', 1)->get();

        foreach ($productos as $producto) {
            $producto->imagen = '<img class="img-thumbnail" src="' . asset($producto->imagen) . '" alt="' . $producto->nombre . '" width="50">';
            $producto->accion = '<div class="d-flex">
                <button class="btn btn-success" type="button" onclick="agregarImagenes(' . $producto->id . ')"><i class="fas fa-images"></i></button>
                <button class="btn btn-primary" type="button" onclick="editPro(' . $producto->id . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="eliminarPro(' . $producto->id . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }

        return response()->json($productos);
    }

    // Registrar o actualizar producto
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $datos = $request->except('imagen');
        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        if (!$request->id) {
            ProductosModel::create($datos);
            return response()->json(['msg' => 'Producto registrado', 'icono' => 'success']);
        }

        ProductosModel::where('id', $request->id)->update($datos);
        return response()->json(['msg' => 'Producto actualizado', 'icono' => 'success']);
    }

    // Eliminar producto (desactivar)
    public function delete($idPro)
    {
        ProductosModel::where('id', $idPro)->update(['estado' => 0]);
        return response()->json(['msg' => 'Producto dado de baja', 'icono' => 'success']);
    }

    // Obtener producto por ID
    public function edit($idPro)
    {
        return response()->json(ProductosModel::find($idPro));
    }

    // Subir imágenes adicionales
    public function galeriaImagenes(Request $request)
    {
        $request->validate([
            'idProducto' => 'required|exists:productos,id',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $ruta = $request->file('file')->store('productos/' . $request->idProducto, 'public');
        return response()->json(['msg' => 'Imagen subida correctamente', 'icono' => 'success', 'ruta' => asset('storage/' . $ruta)]);
    }

    // Ver galería de imágenes
    public function verGaleria($id_producto)
    {
        $ruta = 'productos/' . $id_producto;
        $imagenes = Storage::disk('public')->files($ruta);
        return response()->json($imagenes);
    }

    // Eliminar imagen
    public function eliminarImg(Request $request)
    {
        $request->validate([
            'url' => 'required|string'
        ]);

        if (Storage::disk('public')->exists($request->url)) {
            Storage::disk('public')->delete($request->url);
            return response()->json(['msg' => 'Imagen eliminada', 'icono' => 'success']);
        }
        return response()->json(['msg' => 'Error al eliminar', 'icono' => 'error']);
    }
}