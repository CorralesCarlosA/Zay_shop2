@extends('admin.layouts.app')

@section('title', 'Crear Nueva Reseña')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Reseñas', 'url' => route('admin.reseñas.index')],
['name' => 'Nueva']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.reseñas.store') }}">
                        @csrf

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="n_identificacion_cliente" class="form-label">Cliente</label>
                            <select name="n_identificacion_cliente" id="n_identificacion_cliente" class="form-select"
                                required>
                                <option value="">Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->n_identificacion }}">{{ $cliente->nombres }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Producto -->
                        <div class="mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="idProducto" id="idProducto" class="form-select" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Calificación -->
                        <div class="mb-3">
                            <label for="calificacion" class="form-label">Calificación (1-5)</label>
                            <select name="calificacion" id="calificacion" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} ⭐</option>
                                    @endfor
                            </select>
                        </div>

                        <!-- Comentario -->
                        <div class="mb-3">
                            <label for="comentarios" class="form-label">Comentario (opcional)</label>
                            <textarea name="comentarios" id="comentarios" rows="5" class="form-control"></textarea>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100 mt-3">Guardar Reseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection