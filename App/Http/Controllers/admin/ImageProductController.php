<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\ImageProduct;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class ImageProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las imágenes de un producto
     */
    public function index(int $idProducto)
    {
        $producto = Product::findOrFail($idProducto);
        $imagenes = $producto->images()->orderBy('orden')->get();

        return view('admin.productos.imagenes.index', compact('producto', 'imagenes'));
    }

    /**
     * Formulario para nueva imagen
     */
    public function create(int $idProducto)
    {
        $producto = Product::findOrFail($idProducto);
        return view('admin.productos.imagenes.create', compact('producto'));
    }

    /**
     * Guardar nueva imagen
     */
    public function store(Request $request, int $idProducto)
    {
        $validated = $request->validate([
            'url_imagen' => 'required|url|unique:imagenes_producto,url_imagen,NULL,id_imagen,id_producto,' . $idProducto,
            'orden' => 'required|numeric|min:1'
        ]);

        ImageProduct::create([
            'id_producto' => $idProducto,
            'url_imagen' => $request->input('url_imagen'),
            'orden' => $request->input('orden')
        ]);

        return redirect()->route('admin.productos.imagenes.index', $idProducto)->with('success', 'Imagen agregada correctamente');
    }

    /**
     * Ver detalles de una imagen
     */
    public function show(int $idProducto, int $id_imagen)
    {
        $producto = Product::findOrFail($idProducto);
        $imagen = ImageProduct::where('id_producto', $idProducto)->findOrFail($id_imagen);

        return view('admin.productos.imagenes.show', compact('producto', 'imagen'));
    }

    /**
     * Editar imagen
     */
    public function edit(int $idProducto, int $id_imagen)
    {
        $producto = Product::findOrFail($idProducto);
        $imagen = ImageProduct::where('id_producto', $idProducto)->findOrFail($id_imagen);

        return view('admin.productos.imagenes.edit', compact('producto', 'imagen'));
    }

    /**
     * Actualizar imagen
     */
    public function update(Request $request, int $idProducto, int $id_imagen)
    {
        $imagen = ImageProduct::where('id_producto', $idProducto)->findOrFail($id_imagen);

        $request->validate([
            'url_imagen' => "required|url|unique:imagenes_producto,url_imagen,$id_imagen,id_imagen,id_producto,$idProducto",
            'orden' => 'required|numeric|min:1'
        ]);

        $imagen->fill([
            'url_imagen' => $request->input('url_imagen'),
            'orden' => $request->input('orden')
        ])->save();

        return back()->with('success', 'Imagen actualizada correctamente');
    }

    /**
     * Eliminar imagen
     */
    public function destroy(int $idProducto, int $id_imagen)
    {
        $imagen = ImageProduct::where('id_producto', $idProducto)->findOrFail($id_imagen);
        $imagen->delete();

        return back()->with('success', 'Imagen eliminada correctamente');
    }
}
