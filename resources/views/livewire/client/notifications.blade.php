<div class="position-relative">
    <button class="btn btn-sm btn-outline-primary position-relative" data-bs-toggle="dropdown">
        <i class="bi bi-bell fs-5"></i>
        @if ($noLeidas > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $noLeidas }}
        </span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-end shadow-sm p-3" style="width: 300px;">
        @if ($notificaciones->isEmpty())
        <p class="text-muted text-center mb-0">Sin notificaciones</p>
        @else
        @foreach ($notificaciones as $noti)
        <div class="d-flex justify-content-between align-items-start mb-2 {{ $noti->leido ? 'text-muted' : '' }}">
            <div>
                <strong>{{ Str::limit($noti->titulo, 25) }}</strong><br>
                <small>{{ Str::limit($noti->mensaje, 30) }}</small>
            </div>
            @unless($noti->leido)
            <button wire:click="markAsRead({{ $noti->id_notificacion }})" class="btn btn-sm btn-link p-0">
                <i class="bi bi-check-circle text-success"></i>
            </button>
            @endunless
        </div>
        @endforeach
        @endif
    </div>
</div>