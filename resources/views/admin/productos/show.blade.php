@extends('admin.layouts.app')

@section('title', 'Detalles del Producto #' . $producto->idProducto)
@section('breadcrumbs')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.productos.index') }}">Productos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalle #{{ $producto->idProducto }}</li>
    </ol>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5>{{ $producto->nombreProducto }}</h5>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>ID:</strong> {{ $producto->idProducto }}<br>
                    <strong>Código:</strong> {{ $producto->codigoIdentificador }}<br>
                    <strong>Precio:</strong> ${{ number_format($producto->precioProducto, 2) }}<br>
                    <strong>Categoría:</strong>
                    {{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}<br>
                    <strong>Color:</strong> {{ optional($producto->color)->nombreColor ?? 'Sin color' }}<br>
                    <strong>Talla:</strong> {{ optional($producto->size)->nombre_talla ?? 'Única' }}
                </div>
                <div class="col-md-6 text-md-end">
                    <img src="{{ optional($producto->mainImage())->ruta_imagen ?? '/img/default.jpg' }}"
                        class="img-fluid rounded shadow-sm" alt="Imagen del producto">
                </div>
            </div>

            <div class="mb-3">
                <strong>Descripción:</strong><br>
                <p>{{ $producto->descripcionProducto ?: '-' }}</p>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('admin.productos.edit', $producto->idProducto) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.productos.destroy', $producto->idProducto) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar este producto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection