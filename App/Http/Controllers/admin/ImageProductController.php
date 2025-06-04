<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ImageProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProductController extends Controller
{
    // Mostrar listado de imágenes de un producto
    public function index(int $idProducto)
    {
        $producto = \App\Models\admin\Product::findOrFail($idProducto);
        $imagenes = $producto->images;
        return view('admin.productos.imagenes.index', compact('producto', 'imagenes'));
    }

    // Guardar nuevas imágenes
    public function store(Request $request, int $idProducto)
    {
        $request->validate([
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto = \App\Models\admin\Product::findOrFail($idProducto);

        foreach ($request->file('imagenes') as $imagen) {
            $ruta = $imagen->store('productos/' . $producto->idProducto, 'public');

            $producto->images()->create([
                'url_imagen' => $ruta
            ]);
        }

        return back()->with('success', 'Imágenes subidas correctamente');
    }

    // Eliminar imagen
    public function destroy(int $idProducto, int $id_imagen)
    {
        $imagen = ImageProduct::where('idProducto', $idProducto)->findOrFail($id_imagen);
        Storage::disk('public')->delete($imagen->url_imagen);
        $imagen->delete();

        return back()->with('success', 'Imagen eliminada correctamente');
    }
}