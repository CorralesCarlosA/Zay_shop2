<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home.index') }}">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublicMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarPublicMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.publico.index') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.login') }}">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.register.form') }}">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.carrito.index') }}">
                        <i class="bi bi-cart me-1"></i> Carrito
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>