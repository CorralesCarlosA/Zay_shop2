<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\admin\Notification;
use Illuminate\Support\Facades\Session;

class Notifications extends Component

{
    public $notificaciones = [];
    public $noLeidas = 0;

    protected $listeners = ['markAsRead'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $adminId = Session::get('admin.id_administrador');
        $this->notificaciones = Notification::where('id_administrador', $adminId)
            ->orderByDesc('fecha_creacion')
            ->take(5)
            ->get();

        $this->noLeidas = Notification::where('id_administrador', $adminId)->where('leido', 0)->count();
    }

    public function markAsRead($id_notificacion)
    {
        $noti = Notification::findOrFail($id_notificacion);
        $noti->leido = 1;
        $noti->save();

        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.admin.notifications', [
            'notificaciones' => $this->notificaciones,
            'noLeidas' => $this->noLeidas
        ]);
    }
}