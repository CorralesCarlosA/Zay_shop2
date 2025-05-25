@extends('layouts.app')

@section('title', 'Bienvenido a Nuestra Tienda')

@section('content')
<div class="container">
    <div class="row g-4">
        @forelse ($productos as $producto)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <img src="{{ optional($producto->mainImage)->url_imagen ?? '/img/default.jpg' }}" class="card-img-top"
                    alt="{{ $producto->nombreProducto }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5>{{ Str::limit($producto->nombreProducto, 30) }}</h5>
                    <p class="text-muted mb-2">{{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}
                    </p>
                    <h6>$ {{ number_format($producto->precioProducto, 2) }}</h6>
                    <a href="{{ route('productos.publico.show', $producto->idProducto) }}"
                        class="btn btn-primary mt-auto">Ver Producto</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <p class="text-muted">No hay productos disponibles por ahora.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection