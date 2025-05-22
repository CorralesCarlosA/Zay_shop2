@extends('client.layouts.app')

@section('title', 'Mis Favoritos')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Favoritos']
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Mis Productos Favoritos</h5>
        </div>
        <div class="card-body">

            @if ($favoritos->isEmpty())
            <div class="alert alert-info">No tienes productos favoritos aún.</div>
            @else
            <div class="row g-4">
                @foreach ($favoritos as $favorito)
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ optional($favorito->product->mainImage())->ruta_imagen ?? '/img/default.jpg' }}"
                            class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h6>{{ $favorito->product->nombreProducto }}</h6>
                            <p class="text-muted">${{ number_format($favorito->product->precioProducto, 2) }}</p>
                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('client.productos.show', $favorito->idProducto) }}"
                                    class="btn btn-sm btn-info">Ver</a>
                                <form action="{{ route('client.favoritos.destroy', $favorito->id_favorito) }}"
                                    method="POST" onsubmit="return confirm('¿Eliminar de favoritos?');">
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
            @endif
        </div>
    </div>
</div>
@endsection