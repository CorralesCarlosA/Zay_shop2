      <aside class="admin-sidebar bg-dark text-white">
            <div class="sidebar-header p-3 border-bottom border-secondary">
                <h4 class="mb-0">
                    <i class="fas fa-leaf me-2" style="color: var(--accent-gold);"></i> Panel Admin
                </h4>
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
                        <a href="#productosSubMenu" data-bs-toggle="collapse" aria-expanded="false"
                           class="nav-link {{ request()->is('admin/productos*') ? 'active' : '' }}">
                            <i class="fas fa-box me-2"></i> Productos
                        </a>

                        <ul class="collapse list-unstyled ps-3" id="productosSubMenu">
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.index') ? 'active' : '' }}">
                                    <i class="fas fa-list me-2"></i> Listado
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.clases.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.clases.*') ? 'active' : '' }}">
                                    <i class="fas fa-th-large me-2"></i> Clases
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.marcas.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.marcas.*') ? 'active' : '' }}">
                                    <i class="fas fa-building me-2"></i> Marcas
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.tallas.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.tallas.*') ? 'active' : '' }}">
                                    <i class="fas fa-ruler-combined me-2"></i> Tallas
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.generos.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.generos.*') ? 'active' : '' }}">
                                    <i class="fas fa-venus-mars me-2"></i> Géneros
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.colores.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.colores.*') ? 'active' : '' }}">
                                    <i class="fas fa-palette me-2"></i> Colores
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.productos.comentarios.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.productos.comentarios.*') ? 'active' : '' }}">
                                    <i class="fas fa-comments me-2"></i> Comentarios
                                </a>
                            </li>
                        </ul>
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