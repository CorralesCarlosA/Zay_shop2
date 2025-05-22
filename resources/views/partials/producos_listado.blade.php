<!-- resources/views/partials/productos_listado.blade.php -->

<div class="row g-4" id="productos-listado">
    @forelse ($productos as $producto)
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <img src="{{ optional($producto->mainImage())->ruta_imagen ?? '/img/default.jpg' }}" class="card-img-top"
                style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <h6>{{ Str::limit($producto->nombreProducto, 30) }}</h6>
                <p class="text-muted mb-1">${{ number_format($producto->precioProducto, 2) }}</p>
                @if ($producto->offerStatus?->nombreEstado === 'En oferta')
                <p class="text-danger mb-3">
                    {{ $producto->valor_oferta }}{{ $producto->offerType?->nombreTipo === 'Porcentaje' ? '%' : '$' }}
                    OFF</p>
                @endif
                <a href="{{ route('productos.publico.show', $producto->idProducto) }}"
                    class="btn btn-outline-primary btn-sm mt-auto">Ver Producto</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12 text-center py-5">
        <p class="text-muted">No se encontraron productos con esos filtros.</p>
        <a href="{{ route('home.index') }}" class="btn btn-secondary">Limpiar filtros</a>
    </div>
    @endforelse
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $productos->links() }}
</div>