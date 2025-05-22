@extends('admin.layouts.app')

@section('title', 'Imágenes del Producto #' . $producto->idProducto)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Productos', 'url' => route('admin.productos.index')],
['name' => 'Imágenes del Producto #' . $producto->idProducto]
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Imágenes del Producto #{{ $producto->idProducto }}</h2>
        <a href="{{ route('admin.productos.imagenes.create', $producto->idProducto) }}" class="btn btn-success">Agregar
            Imagen</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Listado de imágenes -->
    <div class="row g-4">
        @foreach ($imagenes as $imagen)
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <img src="{{ $imagen->url_imagen }}" alt="Imagen del producto" class="card-img-top"
                    style="max-height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <p><strong>Orden:</strong> {{ $imagen->orden }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.productos.imagenes.edit', [$producto->idProducto, $imagen->id_imagen]) }}"
                            class="btn btn-sm btn-warning">Editar</a>
                        <form
                            action="{{ route('admin.productos.imagenes.destroy', [$producto->idProducto, $imagen->id_imagen]) }}"
                            method="POST" onsubmit="return confirm('¿Eliminar esta imagen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection