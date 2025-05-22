@extends('admin.layouts.app')

@section('title', 'Agregar Nueva Imagen - Producto #' . $producto->idProducto)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Productos', 'url' => route('admin.productos.index')],
['name' => 'Imágenes', 'url' => route('admin.productos.imagenes.index', $producto->idProducto)],
['name' => 'Nueva']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Agregar Imagen al Producto #{{ $producto->idProducto }}</h4>

                    <form method="POST" action="{{ route('admin.productos.imagenes.store', $producto->idProducto) }}">
                        @csrf

                        <!-- URL de la imagen -->
                        <div class="mb-3">
                            <label for="url_imagen" class="form-label">URL de la Imagen</label>
                            <input type="url" name="url_imagen" id="url_imagen" class="form-control" required
                                placeholder="https://example.com/imagen.jpg ">
                        </div>

                        <!-- Orden -->
                        <div class="mb-3">
                            <label for="orden" class="form-label">Orden</label>
                            <input type="number" name="orden" id="orden" class="form-control" min="1" value="1"
                                required>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection