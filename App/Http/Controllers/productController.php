<?php

namespace App\Http\Controllers;

use App\Models\admin\Product;
use Illuminate\Http\Request;

class ProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de productos (AJAX)
     */
    public function indexPublico(Request $request)
    {
        $query = Product::query();

        if ($request->has('categoria') && $request->input('categoria')) {
            $query->where('id_categoria', $request->input('categoria'));
        }

        if ($request->has('color') && $request->input('color')) {
            $query->whereHas('colors', fn($q) => $q->where('idColor', $request->input('color')));
        }

        if ($request->has('talla') && $request->input('talla')) {
            $query->whereHas('sizes', fn($q) => $q->where('id_talla', $request->input('talla')));
        }

        if ($request->has('sexo') && $request->input('sexo')) {
            $query->where('idSexoProducto', $request->input('sexo'));
        }

        if ($request->has('clase') && $request->input('clase')) {
            $query->where('idClaseProducto', $request->input('clase'));
        }

        if ($request->has('en_oferta') && $request->input('en_oferta')) {
            $query->whereNotNull('idEstadoOferta');
        }

        if ($request->has('min_precio') || $request->has('max_precio')) {
            $min = $request->input('min_precio', 0);
            $max = $request->input('max_precio', 999999);
            $query->whereBetween('precioProducto', [$min, $max]);
        }

        $productos = $query->paginate(12);

        return response()->json([
            'html' => view('partials.productos_listado', compact('productos'))->render(),
            'total' => $productos->total()
        ]);
    }

    /**
     * Mostrar detalles de un producto sin login
     */
    public function showPublico(int $idProducto)
    {
        $producto = Product::with(['mainImage', 'offerType', 'offerStatus', 'colors', 'sizes'])->findOrFail($idProducto);
        return view('productos.show_publico', compact('producto'));
    }
}