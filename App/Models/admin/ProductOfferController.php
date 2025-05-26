<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Product;
use App\Models\admin\OfferStatus;
use App\Models\admin\OfferType;
use App\Models\admin\Administrator;
use App\Models\admin\ProductOffer;
use Illuminate\Http\Request;

class ProductOfferController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las ofertas activas o expiradas
     */
    public function index(Request $request)
    {
        $query = Product::with(['offerStatus', 'offerType']);

        if ($request->has('estado') && $request->input('estado')) {
            $query->where('idEstadoOferta', $request->input('estado'));
        }

        if ($request->has('tipo') && $request->input('tipo')) {
            $query->where('idTipoOferta', $request->input('tipo'));
        }

        $productos = $query->get();
        $estadosOferta = OfferStatus::all();
        $tiposOferta = OfferType::all();

        return view('admin.productos.ofertas.index', compact('productos', 'estadosOferta', 'tiposOferta'));
    }

    /**
     * Formulario para nueva oferta
     */
    public function create()
    {
        $productos = Product::all();
        $estadosOferta = OfferStatus::all();
        $tiposOferta = OfferType::all();
        $admins = Administrator::all();

        return view('admin.productos.ofertas.create', compact('productos', 'estadosOferta', 'tiposOferta', 'admins'));
    }

    /**
     * Guardar nueva oferta
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idProducto' => 'required|int|exists:productos,idProducto',
            'idEstadoOferta' => 'required|int|exists:estadoproducto,idEstadoOferta',
            'idTipoOferta' => 'required|int|exists:tipooferta,idTipoOferta',
            'valor_oferta' => 'required|numeric|min:0.01',
            'fecha_inicio_oferta' => 'nullable|date|before_or_equal:fecha_fin_oferta',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
            'id_administrador_oferta' => 'nullable|int|exists:administradores,id_administrador'
        ]);

        $producto = Product::findOrFail($request->input('idProducto'));

        $producto->fill([
            'idEstadoOferta' => $request->input('idEstadoOferta'),
            'idTipoOferta' => $request->input('idTipoOferta'),
            'valor_oferta' => $request->input('valor_oferta'),
            'fecha_inicio_oferta' => $request->input('fecha_inicio_oferta'),
            'fecha_fin_oferta' => $request->input('fecha_fin_oferta'),
            'id_administrador_oferta' => session('admin.id_administrador')
        ])->save();

        return redirect()->route('admin.productos.ofertas.index')->with('success', 'Oferta creada correctamente');
    }

    /**
     * Ver detalles de una oferta
     */
    public function show(int $idProducto)
    {
        $producto = Product::with(['offerStatus', 'offerType', 'adminOffer'])->findOrFail($idProducto);
        return view('admin.productos.ofertas.show', compact('producto'));
    }

    /**
     * Formulario de edición de oferta
     */
    public function edit(int $idProducto)
    {
        $producto = Product::with(['offerStatus', 'offerType'])->findOrFail($idProducto);
        $estadosOferta = OfferStatus::all();
        $tiposOferta = OfferType::all();

        return view('admin.productos.ofertas.edit', compact('producto', 'estadosOferta', 'tiposOferta'));
    }

    /**
     * Actualizar oferta
     */
    public function update(Request $request, int $idProducto)
    {
        $producto = Product::findOrFail($idProducto);

        $request->validate([
            'idEstadoOferta' => 'required|int|exists:estadoproducto,idEstadoOferta',
            'idTipoOferta' => 'required|int|exists:tipooferta,idTipoOferta',
            'valor_oferta' => 'required|numeric|min:0.01',
            'fecha_inicio_oferta' => 'nullable|date|before_or_equal:fecha_fin_oferta',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
        ]);

        $producto->fill([
            'idEstadoOferta' => $request->input('idEstadoOferta'),
            'idTipoOferta' => $request->input('idTipoOferta'),
            'valor_oferta' => $request->input('valor_oferta'),
            'fecha_inicio_oferta' => $request->input('fecha_inicio_oferta'),
            'fecha_fin_oferta' => $request->input('fecha_fin_oferta'),
            'id_administrador_oferta' => session('admin.id_administrador')
        ])->save();

        return back()->with('success', 'Oferta actualizada correctamente');
    }

    /**
     * Eliminar oferta (no el producto)
     */
    public function destroy(int $idProducto)
    {
        $producto = Product::findOrFail($idProducto);

        $producto->fill([
            'idEstadoOferta' => null,
            'idTipoOferta' => null,
            'valor_oferta' => null,
            'fecha_inicio_oferta' => null,
            'fecha_fin_oferta' => null,
            'id_administrador_oferta' => null
        ])->save();

        return back()->with('success', 'Oferta eliminada correctamente');
    }
}