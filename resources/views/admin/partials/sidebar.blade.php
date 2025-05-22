<!-- resources/views/admin/partials/sidebar.blade.php -->

<aside class="bg-dark text-white min-vh-100 p-3" style="width: 250px;">
    <h5 class="text-white mb-4">Panel Admin</h5>
    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>

        <!-- Productos -->
        @if(session('role')->hasPermissionTo('ver_productos'))
        <li class="nav-item mb-2">
            <a href="#" class="nav-link btn btn-outline-light w-100 text-start dropdown-toggle"
                data-bs-toggle="collapse" data-bs-target="#productosMenu">
                <i class="fas fa-box-open me-2"></i> Productos
            </a>
            <ul id="productosMenu" class="collapse ms-3 mt-2 list-unstyled">
                <li><a href="{{ route('admin.productos.index') }}"
                        class="nav-link btn btn-sm btn-secondary w-100 text-start">Lista de Productos</a></li>
                <li><a href="{{ route('admin.productos.create') }}"
                        class="nav-link btn btn-sm btn-secondary w-100 text-start">Nuevo Producto</a></li>
                <li><a href="{{ route('admin.productos.estado.index') }}"
                        class="nav-link btn btn-sm btn-secondary w-100 text-start">Estados de Producto</a></li>
                <li><a href="{{ route('admin.ofertas.tipo.index') }}"
                        class="nav-link btn btn-sm btn-secondary w-100 text-start">Tipos de Oferta</a></li>
                <li><a href="{{ route('admin.ofertas.estado.index') }}"
                        class="nav-link btn btn-sm btn-secondary w-100 text-start">Estados de Oferta</a></li>
                <li><a href="{{ route('admin.productos.color.index') }}"
                        class="nav-link btn btn-sm btn-secondary w-100 text-start">Colores</a></li>
            </ul>
        </li>
        @endif

        <!-- Clientes -->
        @if(session('role')->hasPermissionTo('ver_clientes'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.clientes.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-users me-2"></i> Clientes
            </a>
        </li>
        @endif

        <!-- Categorías -->
        @if(session('role')->hasPermissionTo('ver_categorias'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.categorias.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-tags me-2"></i> Categorías
            </a>
        </li>
        @endif

        <!-- Cupones -->
        @if(session('role')->hasPermissionTo('ver_cupones'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.cupones.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-ticket-alt me-2"></i> Cupones
            </a>
        </li>
        @endif

        <!-- Pedidos -->
        @if(session('role')->hasPermissionTo('ver_pedidos'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.pedidos.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-truck me-2"></i> Pedidos
            </a>
        </li>
        @endif

        <!-- Ventas -->
        @if(session('role')->hasPermissionTo('ver_ventas'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.ventas.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-shopping-cart me-2"></i> Ventas
            </a>
        </li>
        @endif

        <!-- Devoluciones -->
        @if(session('role')->hasPermissionTo('ver_devoluciones'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.devoluciones.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-undo me-2"></i> Devoluciones
            </a>
        </li>
        @endif

        <!-- Notificaciones -->
        @if(session('role')->hasPermissionTo('enviar_notificaciones'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.notificaciones.index') }}" role="button" aria-expanded="false">
                <i class="bi bi-bell me-2"></i> Notificaciones
                @livewire('admin.notifications')
            </a>
        </li>
        @endif

        <!-- Reseñas -->
        @if(session('role')->hasPermissionTo('aprobar_reseñas'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.reseñas.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('admin.reseñas.*') ? 'active' : '' }}">
                <i class="bi bi-star-fill me-2"></i> Reseñas
            </a>
        </li>
        @endif

        <!-- Administradores -->
        @if(session('role')->hasPermissionTo('gestionar_administradores'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.administradores.index') }}"
                class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-user-shield me-2"></i> Administradores
            </a>
        </li>
        @endif

        <!-- Roles -->
        @if(session('role')->hasPermissionTo('gestionar_roles'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.roles.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-id-badge me-2"></i> Roles
            </a>
        </li>
        @endif

        <!-- Departamentos -->
        @if(session('role')->hasPermissionTo('gestionar_departamentos'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.departamentos.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-city me-2"></i> Departamentos
            </a>
        </li>
        @endif

        <!-- Inventario -->
        @if(session('role')->hasPermissionTo('ver_inventario'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.inventario.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-warehouse me-2"></i> Inventario
            </a>
        </li>
        @endif


        <!-- Soporte -->
        @if(session('role')->hasPermissionTo('ver_mensajes'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.mensajes.index') }}" class="nav-link btn btn-outline-light w-100 text-start">
                <i class="fas fa-envelope me-2"></i> Soporte
            </a>
        </li>
        @endif
        @if(session('role')->hasPermissionTo('ver_reportes_ventas'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.reportes.ventas.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('admin.reportes.ventas.*') ? 'active' : '' }}">
                <i class="bi bi-graph me-2"></i> Reporte de Ventas
            </a>
        </li>
        @if(session('role')->hasPermissionTo('Facturas'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.facturas.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('admin.facturas.*') ? 'active' : '' }}">
                <i class="bi bi-receipt me-2"></i> Facturas
            </a>
        </li>

        @if(session('role')->hasPermissionTo('Reporte_inventario'))
        <li class="nav-item mb-2">
            <a href="{{ route('admin.reportes.inventario.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('admin.reportes.inventario.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i> Reporte de Inventario
            </a>
        </li>

        <a href="{{ route('admin.mensajes.index') }}"
            class="list-group-item list-group-item-action {{ request()->routeIs('admin.mensajes.*') ? 'active' : '' }}">
            <i class="bi bi-chat-left-text me-2"></i> Soporte Técnico
            @php
            $noLeidos = \App\Models\admin\Message::where('estado_mensaje', 'Abierto')->count();
            @endphp
            @if ($noLeidos > 0)
            <span class="badge bg-danger rounded-pill float-end">{{ $noLeidos }}</span>
            @endif
        </a>

        <!-- Cerrar sesión -->
        <li class="nav-item mt-auto pt-3">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100 text-start">
                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                </button>
            </form>
        </li>
    </ul>
</aside>