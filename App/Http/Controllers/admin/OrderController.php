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
    try {
        $query = Order::with(['client', 'shippingCity', 'items'])
                    ->orderBy('fecha_pedido', 'desc');

        // ... (filtros como antes)

        $pedidos = $query->paginate(10);
        
   return view('admin.pedidos.index', [
            'pedidos' => $pedidos // Variable en PLURAL
        ]);
        
    } catch (\Exception $e) {
        return redirect()->back()
                       ->with('error', 'Error al cargar los pedidos: '.$e->getMessage());
    }
}
    /**
     * Formulario para crear un nuevo pedido
     */
    public function create()
    {
        $clientes = \App\Models\admin\Client::orderBy('nombres')->get();
        $productos = \App\Models\admin\Product::with(['inventory'])->get();
        $colores = \App\Models\admin\Color::all();
        $tallas = \App\Models\admin\Size::all();
        $ciudades = \App\Models\admin\City::orderBy('nombre_ciudad')->get();

        return view('admin.pedidos.create', compact(
            'clientes', 
            'productos', 
            'colores', 
            'tallas', 
            'ciudades'
        ));
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
            'producto_talla.*' => 'nullable|int|exists:tallas,id_talla',
            'producto_color.*' => 'nullable|int|exists:colores,id_color',
        ]);

        // Calcular total
        $total = 0;
        foreach ($request->input('producto_id') as $key => $idProducto) {
            $total += $request->input('producto_precio')[$key] * $request->input('producto_cantidad')[$key];
        }

        // Crear el pedido
        $pedido = Order::create([
            'n_identificacion_cliente' => $validated['n_identificacion_cliente'],
            'direccion_envio' => $validated['direccion_envio'],
            'ciudad_envio' => $validated['ciudad_envio'],
            'estado_pedido' => 'En proceso',
            'metodo_pago' => 'Efectivo',
            'total_pedido' => $total,
            'fecha_pedido' => now(),
        ]);

        // Guardar detalles del pedido
        foreach ($request->input('producto_id') as $key => $idProducto) {
            \App\Models\admin\OrderDetail::create([
                'id_pedido' => $pedido->id_pedido,
                'idProducto' => $idProducto,
                'id_talla' => $request->input('producto_talla')[$key],
                'id_color' => $request->input('producto_color')[$key],
                'precio_unitario' => $request->input('producto_precio')[$key],
                'cantidad_pedido' => $request->input('producto_cantidad')[$key],
                'subtotal' => $request->input('producto_precio')[$key] * $request->input('producto_cantidad')[$key]
            ]);

            // Actualizar inventario si es necesario
            if ($producto = \App\Models\admin\Product::find($idProducto)) {
                $producto->inventory->decrement('stock_actual', $request->input('producto_cantidad')[$key]);
            }
        }

        return redirect()->route('admin.pedidos.edit', $pedido->id_pedido)
               ->with('success', 'Pedido creado correctamente');
    }

/**
 * Ver detalles del pedido
 */
public function show($id_pedido)
{
    $pedido = Order::with(['client', 'shippingCity', 'items.product'])
                  ->findOrFail($id_pedido);
                  
    return view('admin.pedidos.show', compact('pedido'));
}

/**
 * Formulario de edición de pedido
 */

// En OrderController
public function edit($id_pedido)
{
    $pedido = Order::with(['client', 'shippingCity', 'items.product'])
                  ->findOrFail($id_pedido);
    
    // Estados consistentes con la base de datos
    $estados = ['En proceso', 'Enviado', 'Entregado', 'Cancelado'];
    
    // Métodos de pago consistentes con la base de datos
    $metodosPago = ['Efectivo', 'Tarjeta', 'Transferencia', 'PayPal', 'Contraentrega'];
    
    return view('admin.pedidos.edit', compact('pedido', 'estados', 'metodosPago'));
}

// public function update(Request $request, int $id_pedido)
// {
//     $pedido = Order::findOrFail($id_pedido);

//     $validated = $request->validate([
//         'estado_pedido' => ['required', Rule::in(['En proceso', 'Enviado', 'Entregado', 'Cancelado'])],
//         'metodo_pago' => ['required', Rule::in(['Efectivo', 'Tarjeta', 'Transferencia', 'PayPal', 'Contraentrega'])],
//         'recoleccion_en_local' => 'boolean',
//         'observaciones' => 'nullable|string|max:500'
//     ]);

//     $pedido->update($validated);

//     return back()->with('success', 'Pedido actualizado correctamente');
// }

    /**
     * Actualizar pedido
     */
    public function update(Request $request, int $id_pedido)
    {
        $pedido = Order::findOrFail($id_pedido);

        $validated = $request->validate([
            'estado_pedido' => ['required', Rule::in(['En proceso', 'Listo para recogida', 'Enviado', 'Entregado', 'Cancelado'])],
            'metodo_pago' => ['required', Rule::in(['Efectivo', 'Tarjeta', 'Transferencia', 'Contraentrega'])],
            'recoleccion_en_local' => 'boolean',
            'observaciones' => 'nullable|string|max:500'
        ]);

        $pedido->update([
            'estado_pedido' => $validated['estado_pedido'],
            'metodo_pago' => $validated['metodo_pago'],
            'recoleccion_en_local' => $request->boolean('recoleccion_en_local'),
            'observaciones' => $validated['observaciones'] ?? null
        ]);

        return back()->with('success', 'Pedido actualizado correctamente');
    }

    /**
     * Eliminar pedido
     */
    public function destroy(int $id_pedido)
    {
        $pedido = Order::with(['items'])->findOrFail($id_pedido);

        // Verificar si se puede eliminar
        if (in_array($pedido->estado_pedido, ['Enviado', 'Entregado'])) {
            return back()->withErrors(['error' => 'No puedes eliminar un pedido ya enviado o entregado']);
        }

        // Restaurar inventario si se cancela
        if ($pedido->estado_pedido === 'Cancelado') {
            foreach ($pedido->items as $item) {
                if ($producto = $item->product) {
                    $producto->inventory->increment('stock_actual', $item->cantidad_pedido);
                }
            }
        }

        $pedido->delete();
        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }
}