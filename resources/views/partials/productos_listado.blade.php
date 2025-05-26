<!-- resources/views/partials/productos_listado.blade.php -->

<div class="row g-4">
    @foreach ($productos as $producto)
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <img src="{{ optional($producto->mainImage)->url_imagen ?? '/img/default.jpg' }}" class="card-img-top"
                alt="{{ $producto->nombreProducto }}" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <h5>{{ Str::limit($producto->nombreProducto, 30) }}</h5>
                <p><strong>${{ number_format($producto->precioProducto, 2) }}</strong></p>
                <a href="{{ route('productos.publico.show', $producto->idProducto) }}"
                    class="btn btn-primary mt-auto">Ver Producto</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if ($productos->isEmpty())
<div class="col-md-12 text-center mt-4">
    <p class="text-muted">No hay productos que coincidan con estos filtros.</p>
</div>
@endif

<div class="mt-4 d-flex justify-content-center">
    {{ $productos->links() }}
</div>