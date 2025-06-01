<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Product;
use App\Models\admin\Client;

class CartItemController extends \App\Http\Controllers\Controller
{


    public function index()
    {
        $cartItems = CartItem::with(['product', 'client', 'size', 'color'])->get();
        return view('admin.carrito.index', compact('cartItems'));
    }

    public function show(int $id_carrito)
    {
        $item = CartItem::with(['product', 'client'])->findOrFail($id_carrito);
        return view('admin.carrito.show', compact('item'));
    }

    public function edit(int $id_carrito)
    {
        $item = CartItem::findOrFail($id_carrito);
        $clients = Client::all();
        $products = Product::all();

        return view('admin.carrito.edit', compact('item', 'clients', 'products'));
    }

    public function update(Request $request, int $id_carrito)
    {
        $item = CartItem::findOrFail($id_carrito);

        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'idProducto' => 'required|exists:productos,idProducto',
            'cantidad' => 'required|integer|min:1',
            'fecha_agregado' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'n_identificacion_cliente',
            'idProducto',
            'cantidad',
            'fecha_agregado'
        ]);

        $item->fill($data)->save();

        return redirect()->route('admin.carrito.index')
            ->with('success', 'Carrito actualizado correctamente');
    }

    public function destroy(int $id_carrito)
    {
        $item = CartItem::findOrFail($id_carrito);
        $item->delete();

        return back()->with('success', 'Elemento del carrito eliminado');
    }
}
