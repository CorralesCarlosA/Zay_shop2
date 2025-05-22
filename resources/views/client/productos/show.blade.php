<!-- client/productos/show.blade.php -->

@extends('layouts.app')

@section('title', 'Detalles del Producto #' . $producto->idProducto)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('home.index')],
['name' => 'Productos', 'url' => route('client.productos.index')],
['name' => 'Detalle #' . $producto->idProducto]
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <div class="col-md-6">
            <img src="{{ optional($producto->mainImage)->ruta_imagen ?? '/img/default.jpg' }}" alt="Imagen del producto"
                class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
            <h2>{{ $producto->nombreProducto }}</h2>
            <p class="lead">{{ $producto->descripcionProducto }}</p>

            <p><strong>Categoría:</strong> {{ optional($producto->category)->nombre_categoria }}</p>
            <p><strong>Género:</strong> {{ optional($producto->gender)->nombre_sexo }}</p>
            <p><strong>Tipo:</strong> {{ optional($producto->classProduct)->nombreClase }}</p>

            <h5>Precio:</h5>
            <p class="fs-4">
                @if ($producto->offerStatus?->nombreEstado === 'En oferta')
                <del>${{ number_format($producto->precioProducto, 2) }}</del>
                <span class="text-danger">
                    @if ($producto->offerType?->nombreTipo === 'Porcentaje')
                    ${{ number_format($producto->precioProducto - ($producto->precioProducto * $producto->valor_oferta / 100), 2) }}
                    ({{ $producto->valor_oferta }}% OFF)
                    @else
                    ${{ number_format($producto->precioProducto - $producto->valor_oferta, 2) }} (Ahora:
                    ${{ number_format($producto->precioProducto - $producto->valor_oferta, 2) }})
                    @endif
                </span>
                @else
                ${{ number_format($producto->precioProducto, 2) }}
                @endif
            </p>

            <form action="{{ route('client.carrito.add', $producto->idProducto) }}" method="POST">
                @csrf
                <input type="hidden" name="cantidad_pedido" value="1">
                <button type="submit" class="btn btn-success w-100">Agregar al Carrito</button>
            </form>
        </div>
    </div>
</div>
@endsection