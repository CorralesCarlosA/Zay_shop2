@extends('admin.layouts.app')

@section('title', 'Detalles de la Oferta #' . $oferta->id_oferta_categoria)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas por Categoría', 'url' => route('admin.ofertas.categoria.index')],
['name' => 'Detalle #' . $oferta->id_oferta_categoria]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Oferta por Categoría #{{ $oferta->id_oferta_categoria }}</h5>
        </div>
        <div class="card-body">

            <p><strong>Categoría:</strong> {{ optional($oferta->category)->nombre_categoria ?? 'No encontrada' }}</p>
            <p><strong>Tipo de Oferta:</strong> {{ optional($oferta->offerType)->nombreTipo ?? 'Sin definir' }}</p>
            <p><strong>Descuento:</strong>
                @if(optional($oferta->offerType)->nombreTipo === 'Porcentaje')
                {{ number_format($oferta->valor_oferta, 2) }}%
                @else
                ${{ number_format($oferta->valor_oferta, 2) }}
                @endif
            </p>
            <p><strong>Fecha de Inicio:</strong> {{ $oferta->fecha_inicio }}</p>
            <p><strong>Fecha de Finalización:</strong> {{ $oferta->fecha_fin }}</p>
            <p><strong>Estado:</strong>
                <span
                    class="badge bg-{{ $oferta->offerStatus?->nombreEstado === 'En oferta' ? 'success' : ($oferta->offerStatus?->nombreEstado === 'Finalizada' ? 'danger' : 'secondary') }}">
                    {{ optional($oferta->offerStatus)->nombreEstado ?? 'Desconocido' }}
                </span>
            </p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.ofertas.categoria.edit', $oferta->id_oferta_categoria) }}"
                    class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.ofertas.categoria.destroy', $oferta->id_oferta_categoria) }}"
                    method="POST" onsubmit="return confirm('¿Eliminar esta oferta por categoría?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection