@extends('client.layouts.app')

@section('title', 'Ofertas Activas')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Ofertas']
])

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Ofertas Disponibles</h2>

    <div class="row g-4">
        @foreach ($ofertasPorCategoria as $oferta)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5>{{ $oferta->category->nombre_categoria }}</h5>
                    <p>Descuento:
                        {{ $oferta->valor_oferta }}{{ $oferta->offerType->nombreTipo === 'Porcentaje' ? '%' : '$' }}</p>
                    <p>Válido hasta: {{ $oferta->fecha_fin }}</p>
                    <a href="{{ route('client.ofertas.categoria.show', $oferta->id_oferta_categoria) }}"
                        class="btn btn-primary w-100">Ver Oferta</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection