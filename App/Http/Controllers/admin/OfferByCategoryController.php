<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\OfferByCategory;
use App\Models\admin\Category;
use App\Models\admin\OfferStatus;
use App\Models\admin\OfferType;
use Illuminate\Http\Request;

class OfferByCategoryController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de ofertas por categoría
     */
    public function index(Request $request)
    {
        $query = OfferByCategory::with(['category', 'offerStatus', 'offerType']);

        if ($request->has('categoria') && $request->input('categoria')) {
            $query->where('id_categoria', $request->input('categoria'));
        }

        if ($request->has('estado') && $request->input('estado')) {
            $query->where('idEstadoOferta', $request->input('estado'));
        }

        $ofertasPorCategoria = $query->get();
        $categorias = Category::all();
        $estados = OfferStatus::all();
        $tipos = OfferType::all();

        return view('admin.ofertas.categorias.index', compact('ofertasPorCategoria', 'categorias', 'estados', 'tipos'));
    }

    /**
     * Formulario para nueva oferta por categoría
     */
    public function create()
    {
        $categorias = Category::all();
        $estados = OfferStatus::all();
        $tipos = OfferType::all();

        return view('admin.ofertas.categorias.create', compact('categorias', 'estados', 'tipos'));
    }

    /**
     * Guardar nueva oferta por categoría
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_categoria' => 'required|int|exists:categorias_productos,id_categoria',
            'idEstadoOferta' => 'required|int|exists:estadooferta,idEstadoOferta',
            'idTipoOferta' => 'required|int|exists:tipooferta,idTipoOferta',
            'valor_oferta' => 'required|numeric|min:0.01',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        OfferByCategory::create([
            'id_categoria' => $request->input('id_categoria'),
            'idEstadoOferta' => $request->input('idEstadoOferta'),
            'idTipoOferta' => $request->input('idTipoOferta'),
            'valor_oferta' => $request->input('valor_oferta'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin')
        ]);

        return redirect()->route('admin.ofertas.categoria.index')->with('success', 'Oferta por categoría creada correctamente');
    }

    /**
     * Ver detalles de una oferta por categoría
     */
    public function show(int $id_oferta_categoria)
    {
        $oferta = OfferByCategory::with(['category', 'offerStatus', 'offerType'])->findOrFail($id_oferta_categoria);
        return view('admin.ofertas.categorias.show', compact('oferta'));
    }

    /**
     * Formulario de edición
     */
    public function edit(int $id_oferta_categoria)
    {
        $oferta = OfferByCategory::findOrFail($id_oferta_categoria);
        $categorias = Category::all();
        $estados = OfferStatus::all();
        $tipos = OfferType::all();

        return view('admin.ofertas.categorias.edit', compact('oferta', 'categorias', 'estados', 'tipos'));
    }

    /**
     * Actualizar oferta por categoría
     */
    public function update(Request $request, int $id_oferta_categoria)
    {
        $oferta = OfferByCategory::findOrFail($id_oferta_categoria);

        $request->validate([
            'id_categoria' => 'required|int|exists:categorias_productos,id_categoria',
            'idEstadoOferta' => 'required|int|exists:estadooferta,idEstadoOferta',
            'idTipoOferta' => 'required|int|exists:tipooferta,idTipoOferta',
            'valor_oferta' => 'required|numeric|min:0.01',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $oferta->fill([
            'id_categoria' => $request->input('id_categoria'),
            'idEstadoOferta' => $request->input('idEstadoOferta'),
            'idTipoOferta' => $request->input('idTipoOferta'),
            'valor_oferta' => $request->input('valor_oferta'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin')
        ])->save();

        return back()->with('success', 'Oferta por categoría actualizada correctamente');
    }

    /**
     * Eliminar oferta por categoría
     */
    public function destroy(int $id_oferta_categoria)
    {
        $oferta = OfferByCategory::findOrFail($id_oferta_categoria);
        $oferta->delete();

        return back()->with('success', 'Oferta por categoría eliminada correctamente');
    }
}
