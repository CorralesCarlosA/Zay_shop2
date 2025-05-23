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
        // Cargar productos activos
        $productos = Product::where('estado_producto', 1)
            ->with(['category', 'brand', 'images'])
            ->paginate(12);

        // Cargar productos destacados
        $destacados = Product::where('estado_producto', 1)
            ->where('destacado', true)
            ->take(4)
            ->get();

        return view('welcome', compact('productos', 'destacados'));
    }

    /**
     * Mostrar productos por categoría
     */
    public function productosPorCategoria($id_categoria)
    {
        $productos = Product::where('estado_producto', 1)
            ->where('id_categoria', $id_categoria)
            ->with(['category', 'brand', 'images'])
            ->paginate(12);

        $destacados = Product::where('estado_producto', 1)
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

        $productos = Product::where('estado_producto', 1)
            ->where(function ($q) use ($query) {
                $q->where('nombreProducto', 'like', "%$query%")
                  ->orWhere('descripcionProducto', 'like', "%$query%");
            })
            ->with(['category', 'brand', 'images'])
            ->paginate(12);

        $destacados = Product::where('estado_producto', 1)
            ->where('destacado', true)
            ->take(4)
            ->get();

        return view('welcome', compact('productos', 'destacados'));
    }
}