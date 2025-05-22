@extends('admin.layouts.app')

@section('title', 'Editar Imagen #' . $imagen->id_imagen . ' - Producto #' . $producto->idProducto)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Productos', 'url' => route('admin.productos.index')],
['name' => 'Imágenes', 'url' => route('admin.productos.imagenes.index', $producto->idProducto)],
['name' => 'Editar Imagen #' . $imagen->id_imagen]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Editar Imagen #{{ $imagen->id_imagen }} del Producto #{{ $producto->idProducto }}</h4>

                    <form method="POST"
                        action="{{ route('admin.productos.imagenes.update', [$producto->idProducto, $imagen->id_imagen]) }}">
                        @csrf
                        @method('PUT')

                        <!-- URL de la imagen -->
                        <div class="mb-3">
                            <label for="url_imagen" class="form-label">URL de la Imagen</label>
                            <input type="url" name="url_imagen" id="url_imagen" class="form-control"
                                value="{{ old('url_imagen', $imagen->url_imagen) }}" required>
                        </div>

                        <!-- Orden -->
                        <div class="mb-3">
                            <label for="orden" class="form-label">Orden</label>
                            <input type="number" name="orden" id="orden" class="form-control" min="1"
                                value="{{ old('orden', $imagen->orden) }}" required>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100">Actualizar Imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection