<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\OfferByCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Category;
use App\Models\admin\OfferStatus;
use App\Models\admin\OfferType;

class OfertasPorCategoriaController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las ofertas por categoría
     */
    public function index()
    {
        $offers = OfferByCategory::with(['category', 'offerStatus', 'offerType'])->get();
        return view('admin.ofertas.categoria.index', compact('offers'));
    }

    /**
     * Mostrar formulario para nueva oferta por categoría
     */
    public function create()
    {
        $categories = Category::all();
        $offerStatuses = OfferStatus::all();
        $offerTypes = OfferType::all();

        return view('admin.ofertas.categoria.create', compact('categories', 'offerStatuses', 'offerTypes'));
    }

    /**
     * Guardar nueva oferta por categoría
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_categoria' => 'required|exists:categorias_productos,id_categoria',
            'idEstadoOferta' => 'required|exists:estadooferta,idEstadoOferta',
            'idTipoOferta' => 'required|exists:tipooferta,idTipoOferta',
            'prioridad' => 'required|integer|min:0',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'id_categoria',
            'idEstadoOferta',
            'idTipoOferta',
            'prioridad',
            'fecha_inicio',
            'fecha_fin'
        ]);

        $offer = new OfferByCategory($validated);
        $offer->save();

        return redirect()->route('admin.ofertas.categoria.show', $offer->id_oferta_categoria)
            ->with('success', 'Oferta por categoría creada correctamente');
    }

    /**
     * Mostrar detalles de una oferta por categoría
     */
    public function show(int $id_oferta_categoria)
    {
        $offer = OfferByCategory::with(['category', 'offerStatus', 'offerType'])->findOrFail($id_oferta_categoria);
        return view('admin.ofertas.categoria.show', compact('offer'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_oferta_categoria)
    {
        $offer = OfferByCategory::with(['category', 'offerStatus', 'offerType'])->findOrFail($id_oferta_categoria);
        $categories = Category::all();
        $offerStatuses = OfferStatus::all();
        $offerTypes = OfferType::all();

        return view('admin.ofertas.categoria.edit', compact('offer', 'categories', 'offerStatuses', 'offerTypes'));
    }

    /**
     * Actualizar oferta por categoría
     */
    public function update(Request $request, int $id_oferta_categoria)
    {
        $offer = OfferByCategory::findOrFail($id_oferta_categoria);

        $validator = Validator::make($request->all(), [
            'id_categoria' => 'required|exists:categorias_productos,id_categoria',
            'idEstadoOferta' => 'required|exists:estadooferta,idEstadoOferta',
            'idTipoOferta' => 'required|exists:tipooferta,idTipoOferta',
            'prioridad' => 'required|integer|min:0',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'id_categoria',
            'idEstadoOferta',
            'idTipoOferta',
            'prioridad',
            'fecha_inicio',
            'fecha_fin'
        ]);

        $offer->fill($data)->save();

        return redirect()->route('admin.ofertas.categoria.index')
            ->with('success', 'Oferta por categoría actualizada correctamente');
    }

    /**
     * Eliminar oferta por categoría
     */
    public function destroy(int $id_oferta_categoria)
    {
        $offer = OfferByCategory::findOrFail($id_oferta_categoria);
        $offer->delete();

        return back()->with('success', 'Oferta por categoría eliminada correctamente');
    }
}
