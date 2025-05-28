<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FavoriteClient as Favorite;

class ClientFavoriteController extends Controller
{
    /**
     * Mostrar favoritos del cliente autenticado
     */
    public function index(Request $request)
    {
        $clienteId = session('client.n_identificacion');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Inicie sesión para ver sus favoritos');
        }

        $favoritos = Favorite::where('n_identificacion_cliente', $clienteId)
            ->with(['product'])
            ->get();

        return view('client.favoritos.index', compact('favoritos'));
    }

    /**
     * Agregar producto a favoritos
     */
    public function store(Request $request, int $idProducto)
    {
        $clienteId = session('client.n_identificacion');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión para agregar a favoritos');
        }

        // Verificar si ya está en favoritos
        $exists = Favorite::where([
            ['n_identificacion_cliente', $clienteId],
            ['idProducto', $idProducto]
        ])->exists();

        if ($exists) {
            return back()->with('error', 'Ya tienes este producto en tus favoritos');
        }

        Favorite::create([
            'n_identificacion_cliente' => $clienteId,
            'idProducto' => $idProducto,
            'fecha_agregado' => now()
        ]);

        return back()->with('success', 'Producto agregado a favoritos');
    }

    /**
     * Eliminar producto de favoritos
     */
    public function destroy(int $id_favorito)
    {
        $favorito = Favorite::where('id_favorito', $id_favorito)
            ->where('n_identificacion_cliente', session('client.n_identificacion'))
            ->firstOrFail();

        $favorito->delete();

        return back()->with('success', 'Producto eliminado de favoritos');
    }
}
