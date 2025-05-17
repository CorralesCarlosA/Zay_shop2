<?php

namespace App\Http\Controllers\client;

use App\Models\client\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Product;

class CartController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los elementos del carrito del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión o autenticación personalizada
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debes iniciar sesión');
        }

        $items = CartItem::where('n_identificacion_cliente', $clienteId)->with('product')->get();

        return view('client.carrito.index', compact('items'));
    }

    /**
     * Agregar producto al carrito
     */
    public function store(Request $request)
    {
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        $validator = Validator::make($request->all(), [
            'idProducto' => 'required|exists:productos,idProducto',
            'cantidad' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Si ya existe este producto en el carrito, actualiza la cantidad
        $existing = CartItem::where([
            ['n_identificacion_cliente', '=', $clienteId],
            ['idProducto', '=', $request->input('idProducto')]
        ])->first();

        if ($existing) {
            $existing->cantidad += $request->input('cantidad', 1);
            $existing->save();
            return redirect()->back()->with('success', 'Cantidad actualizada');
        }

        // Si no existe, lo crea
        CartItem::create([
            'n_identificacion_cliente' => $clienteId,
            'idProducto' => $request->input('idProducto'),
            'cantidad' => $request->input('cantidad', 1),
            'fecha_agregado' => now()
        ]);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Eliminar producto del carrito
     */
    public function destroy(int $id_carrito)
    {
        $item = CartItem::findOrFail($id_carrito);
        $item->delete();

        return back()->with('success', 'Producto eliminado del carrito');
    }
}
