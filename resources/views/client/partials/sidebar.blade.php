<!-- resources/views/client/partials/sidebar.blade.php -->

<div class="list-group">
    <a href="{{ route('client.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="{{ route('client.productos.index') }}" class="list-group-item list-group-item-action">Catálogo</a>
    <a href="{{ route('client.carrito.index') }}" class="list-group-item list-group-item-action">Carrito</a>
    <a href="{{ route('client.favoritos.index') }}" class="list-group-item list-group-item-action">Favoritos</a>
    <a href="{{ route('client.pedidos.index') }}" class="list-group-item list-group-item-action">Mis Pedidos</a>
    <a href="{{ route('client.mensajes.index') }}" class="list-group-item list-group-item-action">Soporte</a>
    <a href="{{ route('client.devoluciones.index') }}" class="list-group-item list-group-item-action">Devoluciones</a>
    <a href="{{ route('client.ofertas.index') }}" class="list-group-item list-group-item-action">Ofertas</a>
    <a href="{{ route('client.logout') }}" class="list-group-item list-group-item-action text-danger">Cerrar Sesión</a>
</div>