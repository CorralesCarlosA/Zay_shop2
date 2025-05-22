@extends('admin.layouts.app')

@section('title', 'Detalle Imagen #' . $imagen->id_imagen)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Productos', 'url' => route('admin.productos.index')],
['name' => 'Imágenes', 'url' => route('admin.productos.imagenes.index', $producto->idProducto)],
['name' => 'Imagen #' . $imagen->id_imagen]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-center">
            <h5>Imagen #{{ $imagen->id_imagen }}</h5>
        </div>
        <div class="card-body text-center">
            <img src="{{ $imagen->url_imagen }}" class="img-fluid rounded shadow-sm" alt="Imagen del producto">
            <p class="mt-3"><strong>URL:</strong> <a href="{{ $imagen->url_imagen }}"
                    target="_blank">{{ $imagen->url_imagen }}</a></p>
            <p><strong>Orden:</strong> {{ $imagen->orden }}</p>

            <div class="d-flex justify-content-center gap-2 mt-4">
                <a href="{{ route('admin.productos.imagenes.edit', [$producto->idProducto, $imagen->id_imagen]) }}"
                    class="btn btn-warning">Editar</a>
                <form
                    action="{{ route('admin.productos.imagenes.destroy', [$producto->idProducto, $imagen->id_imagen]) }}"
                    method="POST" onsubmit="return confirm('¿Eliminar esta imagen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection