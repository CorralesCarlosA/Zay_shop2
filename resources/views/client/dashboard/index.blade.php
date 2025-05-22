@extends('client.layouts.app')

@section('title', 'Mi Dashboard')
@section('breadcrumbs', [
['name' => 'Inicio']
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Mis Pedidos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Mis Pedidos</h5>
                    <p class="text-muted">Ver el estado de tus compras</p>
                    <a href="{{ route('client.pedidos.index') }}" class="btn btn-primary mt-auto">Ver Mis Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Mi Perfil -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Mi Perfil</h5>
                    <p class="text-muted">Datos personales y dirección</p>
                    <a href="{{ route('client.perfil.index') }}" class="btn btn-outline-secondary mt-auto">Editar
                        Perfil</a>
                </div>
            </div>
        </div>

        <!-- Cupones Disponibles -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Cupones Disponibles</h5>
                    <p class="text-muted">Descuentos y promociones</p>
                    <a href="{{ route('client.ofertas.index') }}" class="btn btn-success mt-auto">Ver Cupones</a>
                </div>
            </div>
        </div>

        <!-- Favoritos -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Favoritos</h5>
                    <p class="text-muted">Productos guardados para después</p>
                    <a href="{{ route('client.favoritos.index') }}" class="btn btn-outline-primary mt-auto">Mis
                        Favoritos</a>
                </div>
            </div>
        </div>

        <!-- Carrito -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Mi Carrito</h5>
                    <p class="text-muted">Productos seleccionados para compra</p>
                    <a href="{{ route('client.carrito.index') }}" class="btn btn-warning mt-auto">Ir al Carrito</a>
                </div>
            </div>
        </div>

        <!-- Soporte -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Soporte</h5>
                    <p class="text-muted">Mensajes y ayuda</p>
                    <a href="{{ route('client.mensajes.index') }}" class="btn btn-info text-white mt-auto">Ver
                        Mensajes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection@extends('client.layouts.app')

@section('title', 'Mi Dashboard')
@section('breadcrumbs', [
['name' => 'Inicio']
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Mis Pedidos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Mis Pedidos</h5>
                    <p class="text-muted">Ver el estado de tus compras</p>
                    <a href="{{ route('client.pedidos.index') }}" class="btn btn-primary mt-auto">Ver Mis Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Mi Perfil -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Mi Perfil</h5>
                    <p class="text-muted">Datos personales y dirección</p>
                    <a href="{{ route('client.perfil.index') }}" class="btn btn-outline-secondary mt-auto">Editar
                        Perfil</a>
                </div>
            </div>
        </div>

        <!-- Cupones Disponibles -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Cupones Disponibles</h5>
                    <p class="text-muted">Descuentos y promociones</p>
                    <a href="{{ route('client.ofertas.index') }}" class="btn btn-success mt-auto">Ver Cupones</a>
                </div>
            </div>
        </div>

        <!-- Favoritos -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Favoritos</h5>
                    <p class="text-muted">Productos guardados para después</p>
                    <a href="{{ route('client.favoritos.index') }}" class="btn btn-outline-primary mt-auto">Mis
                        Favoritos</a>
                </div>
            </div>
        </div>

        <!-- Carrito -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Mi Carrito</h5>
                    <p class="text-muted">Productos seleccionados para compra</p>
                    <a href="{{ route('client.carrito.index') }}" class="btn btn-warning mt-auto">Ir al Carrito</a>
                </div>
            </div>
        </div>

        <!-- Soporte -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5>Soporte</h5>
                    <p class="text-muted">Mensajes y ayuda</p>
                    <a href="{{ route('client.mensajes.index') }}" class="btn btn-info text-white mt-auto">Ver
                        Mensajes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection