<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Notification;
use Illuminate\Http\Request;

class NotificationController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de notificaciones
     */
    public function index()
    {
        $adminId = session('admin.id_administrador');

        $notificaciones = Notification::where('id_administrador', $adminId)
            ->orderByDesc('fecha_creacion')
            ->get();

        return view('admin.notificaciones.index', compact('notificaciones'));
    }

    /**
     * Marcar como leído
     */
    public function markAsRead(int $id_notificacion)
    {
        $noti = Notification::findOrFail($id_notificacion);

        if ($noti->leido === 0) {
            $noti->leido = 1;
            $noti->fecha_lectura = now()->toDateString();
            $noti->hora_lectura = now()->toTimeString();
            $noti->save();
        }

        return back();
    }

    /**
     * Eliminar notificación
     */
    public function destroy(int $id_notificacion)
    {
        $noti = Notification::findOrFail($id_notificacion);
        $noti->delete();

        return back()->with('success', 'Notificación eliminada correctamente');
    }
}
