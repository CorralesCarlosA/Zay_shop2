<!-- resources/views/productos/publico/index.blade.php -->
@extends('layouts.app')

@section('title', 'Nuestros Productos')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Nuestros Productos</h1>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('productos.publico.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Buscar productos..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('productos.publico.index') }}">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select name="categoria" class="form-select">
                                    <option value="">Todas las categorías</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}" 
                                        {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                        {{ $categoria->nombre_categoria }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="color" class="form-select">
                                    <option value="">Todos los colores</option>
                                    @foreach($colores as $color)
                                    <option value="{{ $color->idColor }}" 
                                        {{ request('color') == $color->idColor ? 'selected' : '' }}>
                                        {{ $color->nombreColor }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="talla" class="form-select">
                                    <option value="">Todas las tallas</option>
                                    @foreach($tallas as $talla)
                                    <option value="{{ $talla->id_talla }}" 
                                        {{ request('talla') == $talla->id_talla ? 'selected' : '' }}>
                                        {{ $talla->nombre_talla }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de productos -->
    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ optional($producto->mainImage)->ruta_imagen ?? '/img/default.jpg' }}" 
                     class="card-img-top" alt="{{ $producto->nombreProducto }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombreProducto }}</h5>
                    <p class="card-text">
                        <strong>${{ number_format($producto->precioProducto, 2) }}</strong>
                        @if($producto->offerStatus)
                        <span class="badge bg-danger ms-2">Oferta</span>
                        @endif
                    </p>
                    <div class="d-flex flex-wrap gap-1 mb-2">
                        @foreach($producto->colors as $color)
                        <span class="badge bg-light text-dark">{{ $color->nombreColor }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('productos.publico.show', $producto->idProducto) }}" 
                       class="btn btn-primary w-100">Ver Detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="row">
        <div class="col-12">
            {{ $productos->links() }}
        </div>
    </div>
</div>
@endsection