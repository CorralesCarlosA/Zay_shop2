<?php

namespace App\Http\Controllers\client;

use App\Models\client\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Product;

class FavoriteController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los productos favoritos del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión o autenticación personalizada
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        $favorites = Favorite::where('n_identificacion_cliente', $clienteId)->with('product')->get();

        return view('client.favoritos.index', compact('favorites'));
    }

    /**
     * Agregar producto a favoritos
     */
    public function store(Request $request)
    {
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        $validator = Validator::make($request->all(), [
            'idProducto' => 'required|exists:productos,idProducto'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verificar si ya está en favoritos
        $exists = Favorite::where([
            ['n_identificacion_cliente', '=', $clienteId],
            ['idProducto', '=', $request->input('idProducto')]
        ])->first();

        if ($exists) {
            return back()->with('info', 'El producto ya está en tus favoritos');
        }

        // Guardar nuevo favorito
        Favorite::create([
            'n_identificacion_cliente' => $clienteId,
            'idProducto' => $request->input('idProducto'),
            'fecha_agregado' => now()
        ]);

        return redirect()->back()->with('success', 'Producto agregado a favoritos');
    }

    /**
     * Eliminar producto de favoritos
     */
    public function destroy(int $id_favorito)
    {
        $favorite = Favorite::findOrFail($id_favorito);
        $favorite->delete();

        return back()->with('success', 'Producto eliminado de favoritos');
    }
}
