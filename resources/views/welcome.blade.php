<!-- welcome.blade.php -->

@foreach ($productos as $producto)
<div class="col-md-3">
    <div class="card shadow-sm border-0 h-100">
        <img src="{{ optional($producto->mainImage())->ruta_imagen ?? '/img/default.jpg' }}" class="card-img-top"
            style="height: 200px; object-fit: cover;">
        <div class="card-body">
            <h5>{{ Str::limit($producto->nombreProducto, 30) }}</h5>
            <p><strong>${{ number_format($producto->precioProducto, 2) }}</strong></p>

            <div class="small">
                @foreach ($producto->colors as $color)
                <span class="badge bg-light text-dark me-1">{{ $color->nombreColor }}</span>
                @endforeach
            </div>

            <div class="small mt-1">
                @foreach ($producto->sizes as $talla)
                <span class="badge bg-light text-dark me-1">{{ $talla->nombre_talla }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach