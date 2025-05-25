<?php

namespace App\Http\Controllers\admin;

// use App\Http\Controllers\admin\RuleController as Rule;
use App\Http\Controllers\Controller;
use App\Models\admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Mostrar listado de marcas
     */
    public function index(Request $request)
    {
        $query = Brand::query();
    
        if ($request->filled('q')) {
            $query->where('nombre_marca', 'like', "%{$request->input('q')}%");
        }
    
        $marcas = $query->get();
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Mostrar formulario para nueva marca
     */
    public function create()
    {
        return view('admin.marcas.create');
    }

    /**
     * Guardar nueva marca
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_marca' => 'required|string|max:100|unique:marca_producto,nombre_marca',
            'descripcion' => 'nullable|string',
            'estado_marca' => ['required', 'integer', Rule::in([0, 1])]
        ]);

        Brand::create($validated);

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca creada correctamente');
    }

    /**
     * Ver detalles de una marca
     */
    public function show(int $id_marca)
    {
        $marca = Brand::with(['products'])->findOrFail($id_marca);
        return view('admin.marcas.show', compact('marca'));
    }

    /**
     * Formulario de edición
     */
    public function edit(int $id_marca)
    {
        $marca = Brand::findOrFail($id_marca);
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Actualizar marca
     */
    public function update(Request $request, int $id_marca)
    {
        $marca = Brand::findOrFail($id_marca);

        $validated = $request->validate([
            'nombre_marca' => 'required|string|max:100|unique:marca_producto,nombre_marca,' . $id_marca . ',id_marca',
            'descripcion' => 'nullable|string',
            'estado_marca' => ['required', 'integer', Rule::in([0, 1])]
        ]);

        $marca->fill($validated)->save();

        return redirect()->route('admin.marcas.index')
            ->with('success', 'Marca actualizada correctamente');
    }

    /**
     * Eliminar marca (solo si no tiene productos asociados)
     */
    public function destroy(int $id_marca)
    {
        $marca = Brand::findOrFail($id_marca);

        if ($marca->products->isNotEmpty()) {
            return back()->withErrors(['error' => 'No puedes eliminar esta marca porque tiene productos asociados']);
        }

        $marca->delete();

        return back()->with('success', 'Marca eliminada correctamente');
    }
}