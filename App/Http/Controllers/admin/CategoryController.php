<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las categorías
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categorias.index', compact('categories'));
    }

    /**
     * Mostrar formulario para nueva categoría
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Guardar nueva categoría
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_categoria' => 'required|string|max:50|unique:categorias_productos,nombre_categoria',
            'descripcion' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Category::create([
            'nombre_categoria' => $request->input('nombre_categoria'),
            'descripcion' => $request->input('descripcion')
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente');
    }

    /**
     * Mostrar detalles de una categoría
     */
    public function show(int $id_categoria)
    {
        $category = Category::findOrFail($id_categoria);
        return view('admin.categorias.show', compact('category'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_categoria)
    {
        $category = Category::findOrFail($id_categoria);
        return view('admin.categorias.edit', compact('category'));
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, int $id_categoria)
    {
        $category = Category::findOrFail($id_categoria);

        $validator = Validator::make($request->all(), [
            'nombre_categoria' => 'required|string|max:50|unique:categorias_productos,nombre_categoria,' . $id_categoria . ',id_categoria',
            'descripcion' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category->fill([
            'nombre_categoria' => $request->input('nombre_categoria'),
            'descripcion' => $request->input('descripcion')
        ])->save();

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Eliminar categoría
     */
    public function destroy(int $id_categoria)
    {
        $category = Category::findOrFail($id_categoria);
        $category->delete();

        return back()->with('success', 'Categoría eliminada correctamente');
    }
}
