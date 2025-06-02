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
       public function index()
    {
        $marcas = Brand::all();
        return view('admin.productos.brands.index', compact('marcas'));
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
        $request->validate([
            'nombre_marca' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'estado_marca' => 'boolean'
        ]);

        Brand::create($request->all());

        return back()->with('success', 'Marca creada correctamente');
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
 public function update(Request $request, $id_marca)
    {
        $request->validate([
            'nombre_marca' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'estado_marca' => 'boolean'
        ]);

        $marca = Brand::findOrFail($id_marca);
        $marca->update($request->all());

        return back()->with('success', 'Marca actualizada correctamente');
    }

    /**
     * Eliminar marca (solo si no tiene productos asociados)
     */
   public function destroy($id_marca)
    {
        $marca = Brand::findOrFail($id_marca);
        $marca->delete();

        return back()->with('success', 'Marca eliminada correctamente');
    }
}