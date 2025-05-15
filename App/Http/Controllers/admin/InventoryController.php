<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Inventory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Product;
use App\Models\admin\Administrator;

class InventoryController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los registros de inventario
     */
    public function index()
    {
        $inventories = Inventory::with(['product', 'administrator'])->get();
        return view('admin.inventario.index', compact('inventories'));
    }

    /**
     * Mostrar formulario para nuevo registro de inventario
     */
    public function create()
    {
        $products = Product::all();
        $administrators = Administrator::all();

        return view('admin.inventario.create', compact('products', 'administrators'));
    }

    /**
     * Guardar nuevo registro de inventario
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'idProducto' => 'required|exists:productos,idProducto',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'id_administrador' => 'required|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'idProducto',
            'stock_actual',
            'stock_minimo',
            'id_administrador'
        ]);

        // Asignar fecha actual automáticamente
        $validated['fecha_actualizacion'] = now();

        $inventory = new Inventory($validated);
        $inventory->save();

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Inventario creado correctamente');
    }

    /**
     * Mostrar detalles de un registro de inventario
     */
    public function show(int $id_inventario)
    {
        $inventory = Inventory::with(['product', 'administrator'])->findOrFail($id_inventario);
        return view('admin.inventario.show', compact('inventory'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_inventario)
    {
        $inventory = Inventory::with(['product', 'administrator'])->findOrFail($id_inventario);
        $products = Product::all();
        $administrators = Administrator::all();

        return view('admin.inventario.edit', compact('inventory', 'products', 'administrators'));
    }

    /**
     * Actualizar datos del inventario
     */
    public function update(Request $request, int $id_inventario)
    {
        $inventory = Inventory::findOrFail($id_inventario);

        $validator = Validator::make($request->all(), [
            'idProducto' => 'required|exists:productos,idProducto',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'id_administrador' => 'required|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'idProducto',
            'stock_actual',
            'stock_minimo',
            'id_administrador'
        ]);

        // Si hay nueva fecha, usarla. Si no, dejar la que ya tiene
        $data['fecha_actualizacion'] = $request->input('fecha_actualizacion') ?: now();

        $inventory->fill($data)->save();

        return redirect()->route('admin.inventario.index')
            ->with('success', 'Inventario actualizado correctamente');
    }

    /**
     * Eliminar registro de inventario
     */
    public function destroy(int $id_inventario)
    {
        $inventory = Inventory::findOrFail($id_inventario);
        $inventory->delete();

        return back()->with('success', 'Registro de inventario eliminado correctamente');
    }
}
