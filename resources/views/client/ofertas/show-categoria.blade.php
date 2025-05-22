@extends('client.layouts.app')

@section('title', 'Oferta por Categoría #' . $oferta->id_oferta_categoria)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Ofertas', 'url' => route('client.ofertas.index')],
['name' => 'Categoría #' . $oferta->id_oferta_categoria]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h4>Oferta por Categoría: {{ $oferta->category->nombre_categoria }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Tipo de Oferta:</strong> {{ $oferta->offerType->nombreTipo }}</p>
            <p><strong>Descuento:</strong>
                @if ($oferta->offerType->nombreTipo === 'Porcentaje')
                {{ $oferta->valor_oferta }}%
                @else
                ${{ number_format($oferta->valor_oferta, 2) }}
                @endif
            </p>
            <p><strong>Vigente:</strong> {{ $oferta->fecha_inicio }} al {{ $oferta->fecha_fin }}</p>

            <h5>Productos Incluidos</h5>
            <div class="row g-3">
                @foreach ($oferta->category->products as $producto)
                @if ($producto->offerStatus && $producto->offerStatus->nombreEstado === 'En oferta')
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ optional($producto->mainImage())->ruta_imagen ?? '/img/default.jpg' }}"
                            class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ $producto->nombreProducto }}</h6>
                            <p class="text-muted mb-1">Precio original:
                                <del>${{ number_format($producto->precioProducto, 2) }}</del></p>
                            <p class="text-success mb-3">Con oferta:
                                @if ($oferta->offerType->nombreTipo === 'Porcentaje')
                                ${{ number_format($producto->precioProducto - ($producto->precioProducto * $oferta->valor_oferta / 100), 2) }}
                                @else
                                ${{ number_format($producto->precioProducto - $oferta->valor_oferta, 2) }}
                                @endif
                            </p>
                            <a href="{{ route('client.ofertas.producto.show', $producto->idProducto) }}"
                                class="btn btn-primary btn-sm">Ver Producto</a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection