@extends('layouts.app')

@section('title', 'Bienvenido a Nuestra Tienda de Lujo')

@section('content')
<div class="container py-5" style="background-color: #ffffff;">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: #000000;">Nuestra Colección Exclusiva</h1>
        <p class="lead" style="color: #000000;">Descubre productos de la más alta calidad</p>
    </div>

    <div class="row g-4">
        @forelse ($productos as $producto)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100"
                style="transition: transform 0.3s ease; border-radius: 15px; overflow: hidden;">
                <div style="overflow: hidden; height: 200px;">
                    <img src="{{ optional($producto->mainImage)->url_imagen ?? '/img/default.jpg' }}"
                        class="card-img-top w-100 h-100" alt="{{ $producto->nombreProducto }}"
                        style="object-fit: cover; transition: transform 0.5s ease;">
                </div>
                <div class="card-body d-flex flex-column" style="background-color: #f8f9fa;">
                    <h5 style="color: #000000; min-height: 3rem;">{{ Str::limit($producto->nombreProducto, 30) }}</h5>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;">
                        {{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}
                    </p>
                    <h6 style="color: #d4af37; font-weight: bold;">$ {{ number_format($producto->precioProducto, 2) }}
                    </h6>
                    <a href="{{ route('productos.publico.show', $producto->idProducto) }}"
                        class="btn mt-auto align-self-start"
                        style="background-color: #28a745; color: #d4af37; font-weight: bold; border: none; padding: 8px 20px; border-radius: 8px;">
                        <i class="bi bi-eye-fill"></i> Ver Detalles
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center py-5">
            <div class="alert alert-info" style="background-color: #f8f9fa; color: #000000; border: 1px solid #28a745;">
                <i class="bi bi-info-circle-fill" style="color: #d4af37;"></i> No hay productos disponibles por ahora.
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $productos->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.card:hover img {
    transform: scale(1.05);
}

.page-item.active .page-link {
    background-color: #28a745;
    border-color: #28a745;
    color: #d4af37 !important;
}

.page-link {
    color: #28a745;
}

.page-link:hover {
    color: #1e7e34;
}
</style>
@endsection