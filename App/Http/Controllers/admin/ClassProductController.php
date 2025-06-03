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
    return view('admin.productos.classes.index', compact('clases'));
}

    /**
     * Mostrar formulario para nueva clase de producto
     */
public function create()
{
    return view('admin.productos.classes.create');
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
        return view('admin.productos.classes.show', compact('classProduct'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idClaseProducto)
    {
        $classProduct = ClassProduct::findOrFail($idClaseProducto);
        return view('admin.productos.clase.edit', compact('classProduct'));
    }

    /**
     * Actualizar clase de producto
     */
    public function update(Request $request, int $idClaseProducto)
    {
        $classProduct = ClassProduct::findOrFail($idClaseProducto);

        $validator = Validator::make($request->all(), [
            'nombreClase' => 'required|string|max:50|unique:claseproducto,nombreClase,' . $idClaseProducto . ',idClaseProducto',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $classProduct->fill([
            'nombreClase' => $request->input('nombreClase'),
        ])->save();

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
