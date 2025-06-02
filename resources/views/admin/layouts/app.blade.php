<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-dark: #2c4926;
            --primary-light: #3d6b35;
            --accent-gold: #b78732;
            --accent-gold-light: #b79f5e;
            --accent-cream: #EFD9AB;
            --dark-gray: #444242;
            --text-light: #ffffff;
            --text-muted: #e0e0e0;
            --transition-speed: 0.3s;
            --sidebar-width: 280px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #333333;
            overflow-x: hidden;
        }
        
        /* Sidebar elegante */
        .admin-sidebar {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light)) !important;
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .sidebar-header {
            background-color: rgba(0,0,0,0.15) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 1.5rem;
        }
        
        .sidebar-header h4 {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .sidebar-nav {
            padding: 1.5rem;
        }
        
        .sidebar-nav .nav-link {
            color: var(--text-muted);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
        }
        
        .sidebar-nav .nav-link:hover {
            color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar-nav .nav-link.active {
            background-color: var(--accent-gold) !important;
            color: var(--primary-dark) !important;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .sidebar-nav .nav-link i {
            color: var(--accent-cream);
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
        }
        
        .sidebar-nav .nav-link.active i {
            color: var(--primary-dark);
        }
        
        .sidebar-nav .collapse {
            margin-left: 10px;
            border-left: 2px solid var(--accent-gold-light);
        }
        
        /* Navbar mejorado */
        .admin-navbar {
            background-color: white !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            padding: 0.75rem 1.5rem;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            position: fixed;
            z-index: 999;
        }
        
        .navbar-brand {
            color: var(--primary-dark) !important;
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
        
        .navbar-brand i {
            color: var(--accent-gold);
            margin-right: 0.5rem;
        }
        
        .user-dropdown .dropdown-toggle {
            color: var(--primary-dark);
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .user-dropdown .dropdown-toggle img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 0.75rem;
            object-fit: cover;
            border: 2px solid var(--accent-cream);
        }
        
        .user-dropdown .dropdown-toggle::after {
            margin-left: 0.5rem;
        }
        
        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 0.5rem;
        }
        
        .user-dropdown .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .user-dropdown .dropdown-item:hover {
            background-color: var(--accent-cream);
            color: var(--primary-dark);
        }
        
        .user-dropdown .dropdown-item i {
            width: 20px;
            margin-right: 0.5rem;
            color: var(--accent-gold);
        }
        
        /* Contenido principal */
        .dashboard-container {
            padding: 2rem;
            background-color: #f8f9fa;
            min-height: calc(100vh - 56px);
            margin-left: var(--sidebar-width);
            margin-top: 56px;
        }
        
        /* Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .main-content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .secondary-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: all var(--transition-speed) ease;
            overflow: hidden;
            background-color: white;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.25rem;
            font-weight: 600;
            color: var(--primary-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h5 {
            margin-bottom: 0;
            font-weight: 600;
        }
        
        .card-header i {
            color: var(--accent-gold);
            margin-right: 0.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Stats Cards */
        .stat-card {
            border-radius: 12px;
            color: white;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }
        
        .stat-card .card-subtitle {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .stat-card .card-link {
            color: white;
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        
        .stat-card .card-link:hover {
            text-decoration: underline;
            transform: translateX(3px);
        }
        
        .stat-card .card-link i {
            margin-left: 0.3rem;
            font-size: 0.75rem;
        }
        
        /* Gráficos */
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        /* Tablas */
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            color: var(--dark-gray);
            font-weight: 600;
            border-bottom-width: 1px;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(183, 135, 50, 0.05);
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
        }
        
        /* Botones */
        .btn-primary {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
        }
        
        .btn-outline-primary {
            color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        /* Animaciones */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }
        
        .stats-grid > div { animation-delay: 0.1s; }
        .main-content-grid > div:nth-child(1) { animation-delay: 0.2s; }
        .main-content-grid > div:nth-child(2) { animation-delay: 0.3s; }
        .secondary-content-grid > div:nth-child(1) { animation-delay: 0.4s; }
        .secondary-content-grid > div:nth-child(2) { animation-delay: 0.5s; }
        
        /* Responsive */
        @media (max-width: 992px) {
            .main-content-grid {
                grid-template-columns: 1fr;
            }
            
            .secondary-content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-navbar, .dashboard-container {
                margin-left: 0;
                width: 100%;
            }
            
            .navbar-toggler {
                display: block;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
  
        @include('admin.partials.sidebar')
        <div class="flex-grow-1 d-flex flex-column">
            <!-- Navbar mejorado -->
            <nav class="navbar navbar-expand-lg admin-navbar">
                <div class="container-fluid">
                    <button class="navbar-toggler d-lg-none" type="button" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <a class="navbar-brand" href="#">
                        <i class="fas fa-tachometer-alt me-2"></i>Panel Administrativo
                    </a>
                    
                    <div class="d-flex align-items-center">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown user-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Admin Avatar">
                                    Administrador
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Perfil</a></li>
                                    
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
            
            <!-- Contenido principal -->
            <main class="dashboard-container">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery (para AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Toggle sidebar en móviles
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
        
        // Cerrar sidebar al hacer clic fuera en móviles
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.admin-sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                event.target !== sidebarToggle && 
                !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
        
        // AJAX para actualizar estadísticas
        function updateStats() {
            $.ajax({
                url: '/admin/dashboard/stats',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#totalProductos').text(data.totalProductos);
                    $('#totalVentas').text('$' + data.totalVentas.toLocaleString('es-ES', {minimumFractionDigits: 2}));
                    $('#ventasHoy').text('$' + data.ventasHoy.toLocaleString('es-ES', {minimumFractionDigits: 2}));
                    $('#pedidosPendientes').text(data.pedidosPendientes);
                },
                error: function() {
                    console.log('Error al actualizar estadísticas');
                }
            });
        }
        
        // Actualizar estadísticas cada 60 segundos
        setInterval(updateStats, 60000);
        
        // Inicializar tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Inicializar animaciones
            document.querySelectorAll('.animate-card').forEach((el, index) => {
                el.style.animationDelay = `${0.1 * (index + 1)}s`;
            });

            // Gráfico de ventas
            const chartData = document.getElementById('chart-data');
            if (chartData) {
                const ctx = document.getElementById('salesChart');
                if (ctx) {
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: JSON.parse(chartData.dataset.meses),
                            datasets: [{
                                label: 'Ventas',
                                data: JSON.parse(chartData.dataset.ventas),
                                backgroundColor: 'rgba(183, 135, 50, 0.1)',
                                borderColor: 'rgba(183, 135, 50, 1)',
                                borderWidth: 2,
                                tension: 0.3,
                                fill: true,
                                pointBackgroundColor: '#2c4926',
                                pointBorderColor: '#ffffff',
                                pointHoverRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return ' $' + context.raw.toLocaleString();
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0,0,0,0.05)'
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value.toLocaleString();
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>