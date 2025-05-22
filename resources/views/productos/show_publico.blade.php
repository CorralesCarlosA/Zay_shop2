<!-- productos/show_publico.blade.php -->

<h5 class="mt-4">Reseñas de Clientes</h5>
@if ($reseñas->isEmpty())
<p class="text-muted">Aún no hay reseñas sobre este producto.</p>
@else
@foreach ($reseñas as $r)
<div class="card mb-3">
    <div class="card-body">
        <p><strong>{{ optional($r->client)->nombres ?? 'Anónimo' }}</strong></p>
        <div class="d-flex gap-1 text-warning">
            @for ($i = 1; $i <= 5; $i++) {{ $i <= $r->calificacion ? '★' : '☆' }} @endfor </div>
                <p class="mt-2">{{ $r->comentarios }}</p>
        </div>
    </div>
    @endforeach
    @endif

    <h5>Agregar Tu Reseña</h5>
    <form method="POST" action="{{ route('client.productos.resenas.store') }}">
        @csrf
        <input type="hidden" name="idProducto" value="{{ $producto->idProducto }}">

        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificación</label>
            <select name="calificacion" id="calificacion" class="form-select" required>
                <option value="">Puntúa el producto</option>
                @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="comentarios" class="form-label">Escribe tu opinión</label>
            <textarea name="comentarios" id="comentarios" rows="4" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Enviar Reseña</button>
    </form>