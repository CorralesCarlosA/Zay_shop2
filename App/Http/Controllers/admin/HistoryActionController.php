<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\HistoryActionClient;
use Illuminate\Http\Request;

class HistoryActionController extends Controller
{
    /**
     * Mostrar historial de acciones del cliente
     */
    public function index()
    {
        $historial = HistoryActionClient::with(['client'])->get();
        return view('admin.historial-acciones.index', compact('historial'));
    }

    /**
     * Ver detalle de una acción
     */
    public function show(int $id_registro)
    {
        $accion = HistoryActionClient::with(['client'])->findOrFail($id_registro);
        return view('admin.historial-acciones.show', compact('accion'));
    }

    /**
     * Eliminar registro de historial
     */
    public function destroy(int $id_registro)
    {
        $accion = HistoryActionClient::findOrFail($id_registro);
        $accion->delete();

        return back()->with('success', 'Acción eliminada correctamente');
    }
}
