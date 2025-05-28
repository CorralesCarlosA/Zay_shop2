<?php

namespace App\Http\Controllers\Client;

use App\Models\client\Notification;
use Illuminate\Http\Request;

class NotificationController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las notificaciones del cliente autenticado
     */
    public function index(Request $request)
    {
        // Validar sesión del cliente
        $clienteId = session('client.n_identificacion');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión para ver sus notificaciones.');
        }

        // Cargar notificaciones
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
        $notification = Notification::where('id_notificacion', $id_notificacion)
            ->where('n_identificacion_cliente', session('client.n_identificacion'))
            ->firstOrFail();

        $notification->leido = 1;
        $notification->fecha_lectura = now();
        $notification->hora_lectura = now()->format('H:i:s');
        $notification->save();

        return back()->with('success', 'Notificación marcada como leída correctamente.');
    }

    /**
     * Eliminar una notificación
     */
    public function destroy(int $id_notificacion)
    {
        $notification = Notification::where('id_notificacion', $id_notificacion)
            ->where('n_identificacion_cliente', session('client.n_identificacion'))
            ->firstOrFail();

        $notification->delete();

        return back()->with('success', 'Notificación eliminada correctamente.');
    }
}
