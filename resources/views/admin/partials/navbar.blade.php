<nav class="admin-navbar navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-sm btn-outline-light me-3 d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
            <i class="fas fa-bars"></i>
        </button>
        
        <a class="navbar-brand me-auto" href="{{ route('admin.dashboard') }}">
            Panel de Administración
        </a>
        
        <div class="d-flex align-items-center">
            <!-- Notificaciones -->
            <div class="dropdown me-3">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">Notificaciones</h6></li>
                    <li><a class="dropdown-item" href="#">Nuevo pedido recibido</a></li>
                    <li><a class="dropdown-item" href="#">Producto agotado</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Ver todas</a></li>
                </ul>
            </div>
            
            <!-- Perfil -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2"></i>
                    {{ Auth::guard('administradores')->user()->nombre }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Configuración</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>