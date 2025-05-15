<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\OfferStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OfferStatusController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los estados de oferta
     */
    public function index()
    {
        $offerStatuses = OfferStatus::all();
        return view('admin.ofertas.estado.index', compact('offerStatuses'));
    }

    /**
     * Mostrar formulario para nuevo estado de oferta
     */
    public function create()
    {
        return view('admin.ofertas.estado.create');
    }

    /**
     * Guardar nuevo estado de oferta
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|string|max:50|unique:estadooferta,estado'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        OfferStatus::create([
            'estado' => $request->input('estado')
        ]);

        return redirect()->route('admin.ofertas.estado.index')->with('success', 'Estado de oferta creado correctamente');
    }

    /**
     * Mostrar detalles de un estado de oferta
     */
    public function show(int $idEstadoOferta)
    {
        $offerStatus = OfferStatus::findOrFail($idEstadoOferta);
        return view('admin.ofertas.estado.show', compact('offerStatus'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idEstadoOferta)
    {
        $offerStatus = OfferStatus::findOrFail($idEstadoOferta);
        return view('admin.ofertas.estado.edit', compact('offerStatus'));
    }

    /**
     * Actualizar estado de oferta
     */
    public function update(Request $request, int $idEstadoOferta)
    {
        $offerStatus = OfferStatus::findOrFail($idEstadoOferta);

        $validator = Validator::make($request->all(), [
            'estado' => 'required|string|max:50|unique:estadooferta,estado,' . $idEstadoOferta . ',idEstadoOferta'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $offerStatus->fill([
            'estado' => $request->input('estado')
        ])->save();

        return redirect()->route('admin.ofertas.estado.index')
            ->with('success', 'Estado de oferta actualizado correctamente');
    }

    /**
     * Eliminar estado de oferta
     */
    public function destroy(int $idEstadoOferta)
    {
        $offerStatus = OfferStatus::findOrFail($idEstadoOferta);
        $offerStatus->delete();

        return back()->with('success', 'Estado de oferta eliminado correctamente');
    }
}
