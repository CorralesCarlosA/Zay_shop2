<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Tienda de Lujo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
        color: #28a745 !important;
    }

    .dropdown-item i {
        margin-right: 8px;
    }

    body {
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        color: #28a745 !important;
        font-weight: bold;
    }

    .nav-link {
        color: #000000 !important;
    }

    .nav-link:hover {
        color: #d4af37 !important;
    }

    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        color: #d4af37;
    }

    .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
        color: #d4af37;
    }

    footer {
        background-color: #f8f9fa;
        color: #000000;
        padding: 2rem 0;
        margin-top: 3rem;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <i class="bi bi-gem" style="color: #d4af37;"></i> Zay Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}"><i class="bi bi-house-door"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.publico.index') }}"><i class="bi bi-shop"></i>
                            Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}"><i class="bi bi-info-circle"></i> Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-headset"></i> Contacto</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth('clientes')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="color: #000000;">
                            <i class="bi bi-person-fill" style="color: #d4af37;"></i>
                            {{ Auth::guard('clientes')->user()->nombres }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-heart"></i> Favoritos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('client.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.login') }}" style="color: #000000;">
                            <i class="bi bi-box-arrow-in-right" style="color: #d4af37;"></i> Iniciar sesión
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn" href="{{ route('client.register.form') }}"
                            style="background-color: #28a745; color: #d4af37; font-weight: bold;">
                            <i class="bi bi-person-plus"></i> Registrarse
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 style="color: #28a745;">Zay Shop</h5>
                    <p style="color: #000000;">La excelencia en cada producto.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 style="color: #28a745;">Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" style="color: #000000; text-decoration: none;">Inicio</a></li>
                        <li><a href="#" style="color: #000000; text-decoration: none;">Productos</a></li>
                        <li><a href="#" style="color: #000000; text-decoration: none;">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 style="color: #28a745;">Contacto</h5>
                    <ul class="list-unstyled">
                        <li style="color: #000000;"><i class="bi bi-envelope" style="color: #d4af37;"></i>
                            info@Zayshop.com</li>
                        <li style="color: #000000;"><i class="bi bi-phone" style="color: #d4af37;"></i> +57 300 0000 00 00
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: #28a745; opacity: 0.2;">
            <p class="mb-0" style="color: #000000;">
                &copy; {{ date('Y') }} ZayShop. Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>