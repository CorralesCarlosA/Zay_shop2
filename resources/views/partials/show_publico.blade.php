@extends('layouts.app')

@section('title', $producto->nombreProducto)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ optional($producto->mainImage)->url_imagen ?? '/img/default.jpg' }}" class="img-fluid rounded"
                alt="{{ $producto->nombreProducto }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $producto->nombreProducto }}</h2>
            <p>{{ $producto->descripcionProducto }}</p>
            <h4>$ {{ number_format($producto->precioProducto, 2) }}</h4>

            @if ($producto->offerStatus && $producto->offerType)
            <span class="badge bg-danger">{{ $producto->offerType->nombre_tipo_oferta }} -
                {{ $producto->offerStatus->estado_oferta }}</span>
            @endif

            <p><strong>Colores:</strong></p>
            <div class="d-flex gap-2 mb-3">
                @foreach ($producto->colors as $color)
                <span class="badge bg-light text-dark">{{ $color->nombreColor }}</span>
                @endforeach
            </div>

            <p><strong>Tallas:</strong></p>
            <div class="d-flex gap-2">
                @foreach ($producto->sizes as $talla)
                <span class="badge bg-light text-dark">{{ $talla->nombre_talla }}</span>
                @endforeach
            </div>

            <form action="{{ route('client.carrito.add', $producto->idProducto) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success mt-4">Agregar al Carrito</button>
            </form>
        </div>
    </div>
</div>
@endsection