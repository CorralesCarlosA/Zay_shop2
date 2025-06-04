<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Inventory;
use App\Models\admin\Product;
use App\Models\admin\Administrator;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Mostrar listado del inventario
     */
    public function index(Request $request)
    {
        $query = Inventory::with(['product', 'admin']);

        if ($request->has('producto') && $request->input('producto')) {
            $query->where('idProducto', $request->input('producto'));
        }

        if ($request->has('stock') && $request->input('stock')) {
            switch ($request->input('stock')) {
                case 'bajo':
                    $query->whereColumn('stock_actual', '<=', 'stock_minimo');
                    break;
                case 'suficiente':
                    $query->whereColumn('stock_actual', '>', 'stock_minimo');
                    break;
            }
        }

        $inventarios = $query->get();

        $productos = Product::all();
        return view('admin.inventario.index', compact('inventarios', 'productos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $productos = Product::all();
        $admins = Administrator::all();
        return view('admin.inventario.create', compact('productos', 'admins'));
    }

    /**
     * Guardar nuevo inventario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idProducto' => 'required|int|exists:productos,idProducto',
            'stock_actual' => 'required|int|min:0',
            'stock_minimo' => 'required|int|min:0',
            'id_administrador' => 'required|int|exists:administradores,id_administrador'
        ]);

        Inventory::create($validated);

        return redirect()->route('admin.inventario.index')->with('success', 'Inventario creado correctamente');
    }

    /**
     * Mostrar detalles del inventario
     */
public function show(int $id_inventario)
{
    $inventario = Inventory::with(['product', 'admin'])->findOrFail($id_inventario);
    return view('admin.inventario.show', compact('inventario'));
}

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_inventario)
    {
        $inventario = Inventory::with(['product', 'admin'])->findOrFail($id_inventario);
        $productos = Product::all();
        $admins = Administrator::all();
        return view('admin.inventario.edit', compact('inventario', 'productos', 'admins'));
    }

    /**
     * Actualizar inventario
     */
    public function update(Request $request, int $id_inventario)
    {
        $inventario = Inventory::findOrFail($id_inventario);

        $validated = $request->validate([
            'idProducto' => 'sometimes|required|int|exists:productos,idProducto',
            'stock_actual' => 'sometimes|required|int|min:0',
            'stock_minimo' => 'sometimes|required|int|min:0',
            'id_administrador' => 'sometimes|required|int|exists:administradores,id_administrador'
        ]);

        $inventario->fill($validated)->save();

        return back()->with('success', 'Inventario actualizado correctamente');
    }

    /**
     * Eliminar inventario
     */
    public function destroy(int $id_inventario)
    {
        $inventario = Inventory::findOrFail($id_inventario);
        $inventario->delete();
        return back()->with('success', 'Inventario eliminado correctamente');
    }
}