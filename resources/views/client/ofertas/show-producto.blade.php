@extends('client.layouts.app')

@section('title', 'Oferta del Producto #' . $producto->idProducto)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Ofertas', 'url' => route('client.ofertas.index')],
['name' => 'Producto #' . $producto->idProducto]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-center">
            <h4>Oferta del Producto #{{ $producto->idProducto }}</h4>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <img src="{{ optional($producto->mainImage())->ruta_imagen ?? '/img/default.jpg' }}"
                        class="img-fluid rounded shadow-sm" alt="Producto">
                </div>
                <div class="col-md-6">
                    <h5>{{ $producto->nombreProducto }}</h5>
                    <p class="text-muted">{{ $producto->descripcionProducto }}</p>

                    <p><strong>Precio original:</strong> <del>${{ number_format($producto->precioProducto, 2) }}</del>
                    </p>
                    <p><strong>Precio con descuento:</strong>
                        @if ($producto->offerType?->nombreTipo === 'Porcentaje')
                        ${{ number_format($producto->precioProducto - ($producto->precioProducto * $producto->valor_oferta / 100), 2) }}
                        ({{ $producto->valor_oferta }}% OFF)
                        @else
                        ${{ number_format($producto->precioProducto - $producto->valor_oferta, 2) }}
                        (-${{ number_format($producto->valor_oferta, 2) }})
                        @endif
                    </p>
                    <p><strong>Válido hasta:</strong> {{ $producto->fecha_fin_oferta }}</p>

                    <form method="POST" action="{{ route('client.carrito.add', $producto->idProducto) }}">
                        @csrf
                        <input type="hidden" name="cantidad_pedido" value="1">
                        <button type="submit" class="btn btn-success w-100 mt-3">Agregar al Carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection