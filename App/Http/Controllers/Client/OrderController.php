<?php

namespace App\Http\Controllers\client;

use App\Models\client\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Product;
use App\Models\admin\City;

class OrderController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar historial de pedidos del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        // Cargamos todos los pedidos del cliente con relaciones
        $orders = Order::where('n_identificacion_cliente', $clienteId)->with(['city'])->get();

        return view('client.pedidos.index', compact('orders'));
    }

    /**
     * Mostrar detalles de un pedido específico
     */
    public function show(int $id_pedido)
    {
        $pedido = Order::with(['items.product'])->findOrFail($id_pedido);
        return view('client.pedidos.show', compact('pedido'));
    }

    /**
     * Cancelar pedido (si está pendiente)
     */
    public function update(Request $request, int $id_pedido)
    {
        $pedido = Order::findOrFail($id_pedido);

        // Validación simple: solo se puede cancelar si es Pendiente
        if ($pedido->estado_pedido !== 'Pendiente') {
            return back()->with('error', 'Solo puedes cancelar pedidos Pendientes');
        }

        $pedido->estado_pedido = 'Cancelado';
        $pedido->save();

        return back()->with('success', 'Pedido cancelado correctamente');
    }
}
