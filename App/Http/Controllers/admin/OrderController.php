<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\client\Client;
use App\Models\admin\City;

class OrderController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los pedidos
     */
    public function index()
    {
        $orders = Order::with(['client', 'shippingCity'])->get();
        return view('admin.pedidos.index', compact('orders'));
    }

    /**
     * Mostrar formulario para nuevo pedido
     */
    public function create()
    {
        $clients = Client::all();
        $cities = City::all();

        return view('admin.pedidos.create', compact('clients', 'cities'));
    }

    /**
     * Guardar nuevo pedido
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'direccion_envio' => 'required|string|max:255',
            'ciudad_envio' => 'required|exists:ciudades,id_ciudad',
            'total_pedido' => 'required|numeric|min:0',
            'estado_pedido' => ['required', Rule::in(['Pendiente', 'Enviado', 'Completado', 'Cancelado'])],
            'fecha_pedido' => 'nullable|date',
            'hora_pedido' => 'nullable|date_format:H:i:s'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'n_identificacion_cliente',
            'direccion_envio',
            'ciudad_envio',
            'total_pedido',
            'estado_pedido'
        ]);

        // Si no se proporciona fecha/hora, usar ahora
        $validated['fecha_pedido'] = $request->input('fecha_pedido') ?: now()->toDateTimeString();
        $validated['hora_pedido'] = $request->input('hora_pedido') ?: now()->format('H:i:s');

        $order = new Order($validated);
        $order->save();

        return redirect()->route('admin.pedidos.show', $order->id_pedido)
            ->with('success', 'Pedido creado correctamente');
    }

    /**
     * Mostrar detalles de un pedido
     */
    public function show(int $id_pedido)
    {
        $pedido = Order::with(['client', 'shippingCity'])->findOrFail($id_pedido);
        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_pedido)
    {
        $pedido = Order::with(['client', 'shippingCity'])->findOrFail($id_pedido);
        $clients = Client::all();
        $cities = City::all();

        return view('admin.pedidos.edit', compact('pedido', 'clients', 'cities'));
    }

    /**
     * Actualizar pedido
     */
    public function update(Request $request, int $id_pedido)
    {
        $pedido = Order::findOrFail($id_pedido);

        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'direccion_envio' => 'required|string|max:255',
            'ciudad_envio' => 'required|exists:ciudades,id_ciudad',
            'total_pedido' => 'required|numeric|min:0',
            'estado_pedido' => ['required', Rule::in(['Pendiente', 'Enviado', 'Completado', 'Cancelado'])],
            'fecha_pedido' => 'required|date',
            'hora_pedido' => 'required|date_format:H:i:s'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'n_identificacion_cliente',
            'direccion_envio',
            'ciudad_envio',
            'total_pedido',
            'estado_pedido',
            'fecha_pedido',
            'hora_pedido'
        ]);

        $pedido->fill($data)->save();

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido actualizado correctamente');
    }

    /**
     * Eliminar pedido (si aplica)
     */
    public function destroy(int $id_pedido)
    {
        $pedido = Order::findOrFail($id_pedido);
        $pedido->delete();

        return back()->with('success', 'Pedido eliminado correctamente');
    }
}
