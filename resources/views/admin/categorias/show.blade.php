@extends('admin.layouts.app')

@section('title', 'Detalles de la Categoría #' . $categoria->id_categoria)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Categorías', 'url' => route('admin.categorias.index')],
['name' => 'Detalle #' . $categoria->id_categoria]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Categoría #{{ $categoria->id_categoria }}</h5>
        </div>
        <div class="card-body">

            <p><strong>Nombre:</strong> {{ $categoria->nombre_categoria }}</p>
            <p><strong>Descripción:</strong> {{ $categoria->descripcion ?: '-' }}</p>
            <p><strong>Cantidad de Productos:</strong> {{ $categoria->products()->count() }}</p>
            <p><strong>Tiene Oferta:</strong>
                @if ($categoria->offerByCategory)
                Sí ({{ number_format($categoria->offerByCategory->descuento_porcentaje, 2) }}%)
                @else
                No
                @endif
            </p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.categorias.edit', $categoria->id_categoria) }}"
                    class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar esta categoría?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection