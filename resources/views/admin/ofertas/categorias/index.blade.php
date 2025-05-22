@extends('admin.layouts.app')

@section('title', 'Ofertas por Categoría - Panel Admin')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas por Categoría']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Ofertas por Categoría</h2>
        <a href="{{ route('admin.ofertas.categoria.create') }}" class="btn btn-success">Nueva Oferta por Categoría</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.ofertas.categoria.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <select name="categoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}"
                        {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    @foreach ($estados as $estado)
                    <option value="{{ $estado->idEstadoOferta }}"
                        {{ request('estado') == $estado->idEstadoOferta ? 'selected' : '' }}>
                        {{ $estado->nombreEstado }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de ofertas por categoría -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Tipo de Oferta</th>
                <th>Descuento</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ofertasPorCategoria as $oferta)
            <tr>
                <td>{{ $oferta->id_oferta_categoria }}</td>
                <td>{{ optional($oferta->category)->nombre_categoria ?? 'No encontrada' }}</td>
                <td>{{ optional($oferta->offerType)->nombreTipo ?? 'Sin definir' }}</td>
                <td>
                    @if(optional($oferta->offerType)->nombreTipo === 'Porcentaje')
                    {{ number_format($oferta->valor_oferta, 2) }}%
                    @else
                    ${{ number_format($oferta->valor_oferta, 2) }}
                    @endif
                </td>
                <td>{{ $oferta->fecha_inicio }}</td>
                <td>{{ $oferta->fecha_fin }}</td>
                <td>
                    <span class="badge bg-{{ match($oferta->offerStatus?->nombreEstado) {
                            'En oferta' => 'success',
                            'Finalizada' => 'danger',
                            default => 'secondary'
                        } }}">
                        {{ optional($oferta->offerStatus)->nombreEstado ?? 'Desconocido' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.ofertas.categoria.show', $oferta->id_oferta_categoria) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.ofertas.categoria.edit', $oferta->id_oferta_categoria) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.ofertas.categoria.destroy', $oferta->id_oferta_categoria) }}"
                        method="POST" style="display:inline;"
                        onsubmit="return confirm('¿Eliminar esta oferta por categoría?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection