<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class HomeController
{
    /**
     * Mostrar página principal con catálogo de productos
     */
    public function index()
    {
        // Cargar solo productos "Disponibles" (idEstadoProducto = 1)
        $productos = Product::where('idEstadoProducto', 1)
            ->with(['category', 'images'])
            ->paginate(12);

        // Cargar productos destacados si los usas
        $destacados = Product::where('idEstadoProducto', 1)
            ->where('destacado', true)
            ->take(4)
            ->get();

            return view('welcome', compact('productos', 'destacados'));
    }

    public function productosPorMarca($id_marca)
    {
        $productos = Product::where([
            ['idEstadoProducto', 1],
            ['id_marca', $id_marca]
        ])->with(['category', 'brand'])->paginate(12);

        return view('welcome', compact('productos'));
    }

    /**
     * Mostrar productos por categoría
     */
    public function productosPorCategoria($id_categoria)
    {
        $productos = Product::where('idEstadoProducto', 1)
            ->where('id_categoria', $id_categoria)
            ->with(['category', 'brand', 'images'])
            ->paginate(12);

        $destacados = Product::where('idEstadoProducto', 1)
            ->where('destacado', true)
            ->take(4)
            ->get();

        return view('welcome', compact('productos', 'destacados'));
    }

    /**
     * Buscar productos por nombre o descripción
     */
    public function buscar(Request $request)
    {
        $query = $request->input('q');

        $productos = Product::where('idEstadoProducto', 1)
            ->where(function ($q) use ($query) {
                $q->where('nombreProducto', 'like', "%$query%")
                  ->orWhere('descripcionProducto', 'like', "%$query%");
            })
            ->with(['category', 'brand', 'images'])
            ->paginate(12);

        $destacados = Product::where('idEstadoProducto', 1)
            ->where('destacado', true)
            ->take(4)
            ->get();

        return view('welcome', compact('productos', 'destacados'));
    }
}