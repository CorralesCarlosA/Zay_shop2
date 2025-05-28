<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los pedidos
     */
    public function index(Request $request)
    {
        $query = Order::with(['client', 'city']);

        if ($request->has('cliente') && $request->input('cliente')) {
            $search = $request->input('cliente');
            $query->whereHas('client', fn($q) => $q->where('nombres', 'like', "%$search%"));
        }

        if ($request->has('estado_pedido') && $request->input('estado_pedido')) {
            $query->where('estado_pedido', $request->input('estado_pedido'));
        }

        $pedidos = $query->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Formulario para crear un nuevo pedido
     */
    public function create()
    {
        $clientes = \App\Models\client\Client::all();
        $productos = \App\Models\admin\Product::all();
        $colores = \App\Models\admin\Color::all();
        $tallas = \App\Models\admin\Size::all();
        $ciudades = \App\Models\admin\City::all();

        return view('admin.pedidos.create', compact('clientes', 'productos', 'colores', 'tallas', 'ciudades'));
    }

    /**
     * Guardar nuevo pedido
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_identificacion_cliente' => 'required|string|exists:clientes,n_identificacion',
            'direccion_envio' => 'required|string|max:255',
            'ciudad_envio' => 'required|int|exists:ciudades,id_ciudad',
            'producto_id.*' => 'required|int|exists:productos,idProducto',
            'producto_cantidad.*' => 'required|int|min:1',
            'producto_precio.*' => 'required|numeric|min:0.01',
        ]);

        // Crear el pedido
        $pedido = Order::create([
            'n_identificacion_cliente' => $validated['n_identificacion_cliente'],
            'direccion_envio' => $validated['direccion_envio'],
            'ciudad_envio' => $validated['ciudad_envio'],
            'estado_pedido' => 'En proceso',
            'metodo_pago' => 'Efectivo',
            'total_pedido' => array_sum(array_map(fn($precio, $cantidad) => $precio * $cantidad, $request->input('producto_precio'), $request->input('producto_cantidad')))
        ]);

        // Guardar detalles del pedido
        foreach ($request->input('producto_id') as $key => $idProducto) {
            \App\Models\admin\OrderDetail::create([
                'id_pedido' => $pedido->id_pedido,
                'idProducto' => $idProducto,
                'id_talla' => $request->input('producto_talla')[$key] ?? null,
                'id_color' => $request->input('producto_color')[$key] ?? null,
                'precio_unitario' => $request->input('producto_precio')[$key],
                'cantidad_pedido' => $request->input('producto_cantidad')[$key],
                'subtotal' => $request->input('producto_precio')[$key] * $request->input('producto_cantidad')[$key]
            ]);
        }

        return redirect()->route('admin.pedidos.edit', $pedido->id_pedido)->with('success', 'Pedido creado correctamente');
    }

    /**
     * Ver detalles del pedido
     */
    public function show(int $id_pedido)
    {
        $pedido = Order::with(['client', 'details.product'])->findOrFail($id_pedido);
        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Formulario de edición de pedido
     */
    public function edit(int $id_pedido)
    {
        $pedido = Order::with(['client', 'details.product'])->findOrFail($id_pedido);
        $estados = ['En proceso', 'Listo para recogida', 'Enviado', 'Entregado', 'Cancelado'];
        return view('admin.pedidos.edit', compact('pedido', 'estados'));
    }

    /**
     * Actualizar estado_pedido, recoleccion_en_local, metodo_pago
     */
    public function update(Request $request, int $id_pedido)
    {
        $pedido = Order::findOrFail($id_pedido);

        $request->validate([
            'estado_pedido' => ['required', Rule::in(['En proceso', 'Listo para recogida', 'Enviado', 'Entregado', 'Cancelado'])],
            'metodo_pago' => ['required', Rule::in(['Efectivo', 'Tarjeta', 'Transferencia', 'Contraentrega'])],
            'recoleccion_en_local' => 'nullable|boolean'
        ]);

        $pedido->fill([
            'estado_pedido' => $request->input('estado_pedido'),
            'metodo_pago' => $request->input('metodo_pago'),
            'recoleccion_en_local' => $request->has('recoleccion_en_local') ? 1 : 0
        ])->save();

        return back()->with('success', 'Pedido actualizado correctamente');
    }

    /**
     * Eliminar pedido (si no está enviado o entregado)
     */
    public function destroy(int $id_pedido)
    {
        $pedido = Order::findOrFail($id_pedido);

        if (!$pedido->canBeDeleted()) {
            return back()->withErrors(['error' => 'No puedes eliminar un pedido ya enviado o entregado']);
        }

        $pedido->delete();
        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }
}