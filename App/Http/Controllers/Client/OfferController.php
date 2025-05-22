<?php

namespace App\Http\Controllers\client;

use App\Models\admin\Product;
use App\Models\admin\OfferByCategory;
use Illuminate\Http\Request;

class OfferController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las ofertas disponibles para el cliente
     */
    public function index(Request $request)
    {
        // Productos con ofertas activas
        $productosConOferta = Product::with(['offerType', 'offerStatus'])
            ->whereNotNull('idEstadoOferta')
            ->whereHas('offerStatus', fn($q) => $q->where('nombreEstado', 'En oferta'))
            ->whereDate('fecha_inicio_oferta', '<=', now())
            ->whereDate('fecha_fin_oferta', '>=', now())
            ->get();

        // Ofertas por categoría
        $ofertasPorCategoria = OfferByCategory::with(['category', 'offerType', 'offerStatus'])
            ->whereHas('offerStatus', fn($q) => $q->where('nombreEstado', 'En oferta'))
            ->whereDate('fecha_inicio', '<=', now())
            ->whereDate('fecha_fin', '>=', now())
            ->get();

        return view('client.ofertas.index', compact('productosConOferta', 'ofertasPorCategoria'));
    }

    /**
     * Ver detalles de una oferta por producto
     */
    public function showProducto(int $idProducto)
    {
        $producto = Product::with(['offerType', 'offerStatus'])->findOrFail($idProducto);

        if (!$producto->offerStatus || $producto->offerStatus->nombreEstado !== 'En oferta') {
            abort(404);
        }

        return view('client.ofertas.show_producto', compact('producto'));
    }

    /**
     * Ver detalles de una oferta por categoría
     */
    public function showCategoria(int $id_oferta_categoria)
    {
        $oferta = OfferByCategory::with(['category', 'offerType', 'offerStatus'])->findOrFail($id_oferta_categoria);

        if ($oferta->offerStatus->nombreEstado !== 'En oferta') {
            abort(404);
        }

        return view('client.ofertas.show_categoria', compact('oferta'));
    }
}
