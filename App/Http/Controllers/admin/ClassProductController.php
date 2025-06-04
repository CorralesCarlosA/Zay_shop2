<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\ClassProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ClassProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las clases de producto
     */
public function index()
{
    $clases = ClassProduct::all();
    // Corregir la ruta de la vista (faltaba un punto)
    return view('admin.productos.clases.index', compact('clases'));
}

    /**
     * Mostrar formulario para nueva clase de producto
     */
public function create()
{
    return view('admin.productos.clases.create');
}
    /**
     * Guardar nueva clase de producto
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nombreClase' => 'required|string|max:50|unique:claseproducto,clase'
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    ClassProduct::create([
        'clase' => $request->input('nombreClase')
    ]);

    return redirect()->route('admin.productos.classes.index')
        ->with('success', 'Clase de producto creada correctamente');
}

    /**
     * Mostrar detalles de una clase de producto
     */
    public function show(int $idClaseProducto)
    {
        $classProduct = ClassProduct::findOrFail($idClaseProducto);
        return view('admin.productos.clases.show', compact('classProduct'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idClaseProducto)
    {
        $classProduct = ClassProduct::findOrFail($idClaseProducto);
        return view('admin.productos.clases.edit', compact('classProduct'));
    }

    /**
     * Actualizar clase de producto
     */
 public function update(Request $request, int $idClaseProducto)
{
    $classProduct = ClassProduct::findOrFail($idClaseProducto);

    $validator = Validator::make($request->all(), [
        // Corregir el nombre del campo (de nombreClase a clase)
        'nombreClase' => 'required|string|max:50|unique:claseproducto,clase,' . $idClaseProducto . ',idClaseProducto',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $classProduct->update([
        'clase' => $request->input('nombreClase') // Usar 'clase' en lugar de 'nombreClase'
    ]);

    return redirect()->route('admin.productos.classes.index')
        ->with('success', 'Clase actualizada correctamente');
}

    /**
     * Eliminar clase de producto
     */
    public function destroy(int $idClaseProducto)
    {
        $classProduct = ClassProduct::findOrFail($idClaseProducto);
        $classProduct->delete();

        return back()->with('success', 'Clase de producto eliminada correctamente');
    }
}
