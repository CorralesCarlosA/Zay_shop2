<?php

namespace App\Http\Controllers\client;

use App\Models\client\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las notificaciones del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        // Cargamos todas las notificaciones del cliente
        $notifications = Notification::where('n_identificacion_cliente', $clienteId)
            ->orderByDesc('fecha_envio')
            ->with(['administrator'])
            ->get();

        return view('client.notificaciones.index', compact('notifications'));
    }

    /**
     * Marcar una notificación como leída
     */
    public function update(Request $request, int $id_notificacion)
    {
        $notification = Notification::findOrFail($id_notificacion);

        $notification->leido = 1;
        $notification->fecha_lectura = now();
        $notification->save();

        return back()->with('success', 'Notificación marcada como leída');
    }

    /**
     * Eliminar una notificación (opcional)
     */
    public function destroy(int $id_notificacion)
    {
        $notification = Notification::findOrFail($id_notificacion);
        $notification->delete();

        return back()->with('success', 'Notificación eliminada correctamente');
    }
}
