<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use App\Models\client\Notification as NotificationClient;
use Illuminate\Support\Facades\Session;

class Notifications extends Component
{
    public $notificaciones = [];
    public $noLeidas = 0;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $clienteId = Session::get('client.n_identificacion');

        $this->notificaciones = NotificationClient::where('n_identificacion_cliente', $clienteId)
            ->orderByDesc('fecha_envio')
            ->take(5)
            ->get();

        $this->noLeidas = NotificationClient::where('n_identificacion_cliente', $clienteId)
            ->where('leido', 0)
            ->count();
    }

    public function markAsRead($id_notificacion)
    {
        $noti = NotificationClient::findOrFail($id_notificacion);
        $noti->leido = 1;
        $noti->save();

        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.client.notifications', [
            'notificaciones' => $this->notificaciones,
            'noLeidas' => $this->noLeidas
        ]);
    }
}