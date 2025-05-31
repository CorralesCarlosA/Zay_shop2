<aside class="admin-sidebar bg-dark text-white">
    <div class="sidebar-header p-3 border-bottom border-secondary">
        <h4 class="mb-0">Panel Admin</h4>
    </div>
    
    <nav class="sidebar-nav p-3">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            
            <!-- Productos -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.productos.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.productos.*') ? 'active' : '' }}">
                    <i class="fas fa-box me-2"></i> Productos
                </a>
            </li>
            
            <!-- Pedidos -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.pedidos.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.pedidos.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart me-2"></i> Pedidos
                </a>
            </li>
            
            <!-- Clientes -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.clientes.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> Clientes
                </a>
            </li>
            
            <!-- Ventas -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.ventas.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.ventas.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i> Ventas
                </a>
            </li>
            
            <!-- Reportes -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.reportes.ventas.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.reportes.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i> Reportes
                </a>
            </li>
            
            <!-- Cerrar sesión -->
            <li class="nav-item mt-4 pt-3 border-top border-secondary">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link bg-transparent border-0 text-start w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>