<?php

namespace App\Http\Controllers\Client;

use App\Models\client\HistoryAction;
use Illuminate\Http\Request;

class HistoryActionController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar historial de acciones del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        // Cargamos todas las acciones del cliente
        $acciones = HistoryAction::where('n_identificacion_cliente', $clienteId)
            ->orderByDesc('fecha_accion')
            ->get();

        return view('client.historial.index', compact('acciones'));
    }

    /**
     * Mostrar detalles de una acción específica
     */
    public function show(int $id_registro)
    {
        $accion = HistoryAction::findOrFail($id_registro);

        // Validar que sea del cliente autenticado
        $clienteId = request()->session()->get('cliente_id');
        if ($accion->n_identificacion_cliente !== $clienteId) {
            abort(403, 'Acceso denegado');
        }

        return view('client.historial.show', compact('accion'));
    }

    /**
     * Eliminar un registro de acción (opcional)
     */
    public function destroy(int $id_registro)
    {
        $accion = HistoryAction::findOrFail($id_registro);

        // Solo el cliente puede eliminar su propio historial
        $clienteId = request()->session()->get('cliente_id');

        if ($accion->n_identificacion_cliente !== $clienteId) {
            abort(403, 'No puedes eliminar este registro');
        }

        $accion->delete();
        return back()->with('success', 'Acción eliminada del historial');
    }
}