<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons @1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos personalizados (opcional) -->
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Mi Tienda - Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdminMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarAdminMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                                class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}"><i
                                class="bi bi-box-arrow-right me-1"></i> Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid py-4 flex-grow-1">
        <div class="row g-4">

            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-none d-md-block bg-light border-end h-100 sticky-top" style="top: 56px;">
                @include('admin.partial.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-md-auto px-4">
                <!-- Breadcrumbs -->
                @yield('breadcrumbs')

                <!-- Mensajes flash -->
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Contenido dinámico -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Mi Tienda - Panel de Administración</p>
        </div>
    </footer>

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts adicionales -->
    @stack('scripts')

</body>

</html>