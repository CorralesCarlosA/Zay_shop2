@extends('admin.layouts.app')

@section('title', 'Editar Reseña #' . $reseña->id_reseña)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.resenas.index') }}">Reseñas</a></li>
    <li class="breadcrumb-item active">Editar #{{ $reseña->id_reseña }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.reseñas.update', $reseña->id_reseña) }}">
                        @csrf
                        @method('PUT')

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="n_identificacion_cliente" class="form-label">Cliente</label>
                            <select name="n_identificacion_cliente" id="n_identificacion_cliente" class="form-select"
                                disabled>
                                <option value="{{ $reseña->n_identificacion_cliente }}" selected>
                                    {{ optional($reseña->client)->nombres }}
                                </option>
                            </select>
                        </div>

                        <!-- Producto -->
                        <div class="mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="idProducto" id="idProducto" class="form-select" disabled>
                                <option value="{{ $reseña->idProducto }}" selected>
                                    {{ optional($reseña->product)->nombreProducto }}
                                </option>
                            </select>
                        </div>

                        <!-- Calificación -->
                        <div class="mb-3">
                            <label for="calificacion" class="form-label">Calificación (1-5)</label>
                            <select name="calificacion" id="calificacion" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}"
                                    {{ $reseña->calificacion == $i ? 'selected' : '' }}>
                                    {{ $i }} ⭐
                                    </option>
                                    @endfor
                            </select>
                        </div>

                        <!-- Comentario -->
                        <div class="mb-3">
                            <label for="comentarios" class="form-label">Comentario</label>
                            <textarea name="comentarios" id="comentarios" rows="5"
                                class="form-control">{{ old('comentarios', $reseña->comentarios) }}</textarea>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">Actualizar Reseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection