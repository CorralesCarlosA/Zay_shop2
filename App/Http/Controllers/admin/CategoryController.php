<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Category;
use Illuminate\Http\Request;

class CategoryController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las categorías
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('nombre_categoria') && $request->input('nombre_categoria')) {
            $search = $request->input('nombre_categoria');
            $query->where('nombre_categoria', 'like', "%$search%");
        }

        $categorias = $query->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Formulario para nueva categoría
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
        $validated = $request->validate([
            'nombre_categoria' => 'required|string|max:50|unique:categorias_productos,nombre_categoria',
            'descripcion' => 'nullable|string'
        ]);

        Category::create($validated);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente');
    }

    /**
     * Ver detalles de una categoría
     */
    public function show(int $id_categoria)
    {
        $categoria = Category::with(['products'])->findOrFail($id_categoria);
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Formulario de edición
     */
    public function edit(int $id_categoria)
    {
        $categoria = Category::findOrFail($id_categoria);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, int $id_categoria)
    {
        $categoria = Category::findOrFail($id_categoria);

        $validated = $request->validate([
            'nombre_categoria' => "required|string|max:50|unique:categorias_productos,nombre_categoria,$id_categoria,id_categoria",
            'descripcion' => 'nullable|string'
        ]);

        $categoria->fill([
            'nombre_categoria' => $request->input('nombre_categoria'),
            'descripcion' => $request->input('descripcion')
        ])->save();

        return back()->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Eliminar categoría (si no tiene productos ni ofertas)
     */
    public function destroy(int $id_categoria)
    {
        $categoria = Category::findOrFail($id_categoria);

        if ($categoria->products()->exists()) {
            return back()->withErrors(['error' => 'No puedes eliminar una categoría que tenga productos']);
        }

        if ($categoria->offerByCategory()->exists()) {
            return back()->withErrors(['error' => 'Esta categoría tiene ofertas activas']);
        }

        $categoria->delete();
        return back()->with('success', 'Categoría eliminada correctamente');
    }
}
