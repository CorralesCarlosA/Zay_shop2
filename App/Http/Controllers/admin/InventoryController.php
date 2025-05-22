<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Inventory;
use App\Models\admin\Product;
use App\Models\admin\Administrator;
use Illuminate\Http\Request;

class InventoryController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de inventarios
     */
    public function index(Request $request)
    {
        $query = Inventory::with(['product', 'admin']);

        if ($request->has('producto') && $request->input('producto')) {
            $query->whereHas('product', fn($q) => $q->where('nombreProducto', 'like', "%{$request->input('producto')}%"));
        }

        if ($request->has('stock_minimo') && $request->input('stock_minimo')) {
            $query->where('stock_minimo', '<=', $request->input('stock_minimo'));
        }

        $inventarios = $query->get();
        return view('admin.inventario.index', compact('inventarios'));
    }

    /**
     * Formulario para nuevo inventario
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

        Inventory::create([
            'idProducto' => $request->input('idProducto'),
            'stock_actual' => $request->input('stock_actual'),
            'stock_minimo' => $request->input('stock_minimo'),
            'id_administrador' => $request->input('id_administrador')
        ]);

        return redirect()->route('admin.inventario.index')->with('success', 'Inventario creado correctamente');
    }

    /**
     * Ver detalles del inventario
     */
    public function show(int $id_inventario)
    {
        $inventario = Inventory::with(['product', 'admin'])->findOrFail($id_inventario);
        return view('admin.inventario.show', compact('inventario'));
    }

    /**
     * Formulario de edición
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

        $request->validate([
            'idProducto' => 'required|int|exists:productos,idProducto',
            'stock_actual' => 'required|int|min:0',
            'stock_minimo' => 'required|int|min:0',
            'id_administrador' => 'required|int|exists:administradores,id_administrador'
        ]);

        $inventario->fill([
            'idProducto' => $request->input('idProducto'),
            'stock_actual' => $request->input('stock_actual'),
            'stock_minimo' => $request->input('stock_minimo'),
            'id_administrador' => $request->input('id_administrador')
        ])->save();

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
