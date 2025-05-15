<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductStatusController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los estados de producto
     */
    public function index()
    {
        $productStatuses = ProductStatus::all();
        return view('admin.productos.estado.index', compact('productStatuses'));
    }

    /**
     * Mostrar formulario para crear nuevo estado de producto
     */
    public function create()
    {
        return view('admin.productos.estado.create');
    }

    /**
     * Guardar nuevo estado de producto
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|string|max:50|unique:estadoproducto,estado'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only(['estado']);

        $productStatus = new ProductStatus($validated);
        $productStatus->save();

        return redirect()->route('admin.productos.estado.index')
            ->with('success', 'Estado de producto creado correctamente');
    }

    /**
     * Mostrar detalles de un estado de producto
     */
    public function show(int $idEstadoProducto)
    {
        $productStatus = ProductStatus::findOrFail($idEstadoProducto);
        return view('admin.productos.estado.show', compact('productStatus'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idEstadoProducto)
    {
        $productStatus = ProductStatus::findOrFail($idEstadoProducto);
        return view('admin.productos.estado.edit', compact('productStatus'));
    }

    /**
     * Actualizar estado de producto
     */
    public function update(Request $request, int $idEstadoProducto)
    {
        $productStatus = ProductStatus::findOrFail($idEstadoProducto);

        $validator = Validator::make($request->all(), [
            'estado' => 'required|string|max:50|unique:estadoproducto,estado,' . $idEstadoProducto . ',idEstadoProducto'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $productStatus->fill([
            'estado' => $request->input('estado'),
        ])->save();

        return redirect()->route('admin.productos.estado.index')
            ->with('success', 'Estado actualizado correctamente');
    }

    /**
     * Eliminar estado de producto
     */
    public function destroy(int $idEstadoProducto)
    {
        $productStatus = ProductStatus::findOrFail($idEstadoProducto);
        $productStatus->delete();

        return back()->with('success', 'Estado de producto eliminado correctamente');
    }
}
