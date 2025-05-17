<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">ZayShop Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Notificaciones -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        @php
                        // Ejemplo: obtener notificaciones no leídas
                        $notificacionesNoLeidas = \App\Models\admin\Notification::where('leido', 0)->count();
                        @endphp
                        @if($notificacionesNoLeidas > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $notificacionesNoLeidas }}
                        </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0 border-0 shadow">
                        <li>
                            <h6 class="dropdown-header">Notificaciones</h6>
                        </li>
                        @forelse(\App\Models\admin\Notification::where('id_administrador',
                        auth()->user()->id_administrador)->take(5)->get() as $notif)
                        <li>
                            <a class="dropdown-item small py-2 {{ $notif->leido ? '' : 'bg-light' }}" href="#">
                                <strong>{{ Str::limit($notif->titulo, 20) }}</strong><br>
                                <small>{{ Str::limit($notif->mensaje, 40) }}</small>
                            </a>
                        </li>
                        @empty
                        <li class="dropdown-item text-center">Sin notificaciones</li>
                        @endforelse
                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        <li><a class="dropdown-item small text-center"
                                href="{{ route('admin.notificaciones.index') }}">Ver todas</a></li>
                    </ul>
                </li>

                <!-- Perfil -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="perfilDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2 fs-5"></i>
                        <span class="d-none d-md-inline">{{ auth()->user()->nombres }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Ajustes</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>