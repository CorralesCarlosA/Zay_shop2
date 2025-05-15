<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\OfferType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OfferTypeController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar lista de tipos de oferta
     */
    public function index()
    {
        $offerTypes = OfferType::all();
        return view('admin.ofertas.tipo.index', compact('offerTypes'));
    }

    /**
     * Mostrar formulario para crear tipo de oferta
     */
    public function create()
    {
        return view('admin.ofertas.tipo.create');
    }

    /**
     * Guardar nuevo tipo de oferta
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreTipo' => 'required|string|max:50|unique:tipooferta,nombreTipo',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only(['nombreTipo']);

        $offerType = new OfferType($validated);
        $offerType->save();

        return redirect()->route('admin.ofertas.tipo.index')
            ->with('success', 'Tipo de oferta creado correctamente');
    }

    /**
     * Mostrar detalles de un tipo de oferta
     */
    public function show(int $idTipoOferta)
    {
        $offerType = OfferType::findOrFail($idTipoOferta);
        return view('admin.ofertas.tipo.show', compact('offerType'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idTipoOferta)
    {
        $offerType = OfferType::findOrFail($idTipoOferta);
        return view('admin.ofertas.tipo.edit', compact('offerType'));
    }

    /**
     * Actualizar tipo de oferta
     */
    public function update(Request $request, int $idTipoOferta)
    {
        $offerType = OfferType::findOrFail($idTipoOferta);

        $validator = Validator::make($request->all(), [
            'nombreTipo' => 'required|string|max:50|unique:tipooferta,nombreTipo,' . $idTipoOferta . ',idTipoOferta',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $offerType->fill([
            'nombreTipo' => $request->input('nombreTipo'),
        ])->save();

        return redirect()->route('admin.ofertas.tipo.index')
            ->with('success', 'Tipo de oferta actualizado correctamente');
    }

    /**
     * Eliminar tipo de oferta
     */
    public function destroy(int $idTipoOferta)
    {
        $offerType = OfferType::findOrFail($idTipoOferta);
        $offerType->delete();

        return back()->with('success', 'Tipo de oferta eliminado correctamente');
    }
}
