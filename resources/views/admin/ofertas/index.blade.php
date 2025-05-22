@extends('admin.layouts.app')

@section('title', 'Ofertas de Productos')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Ofertas</h2>
        <a href="{{ route('admin.productos.ofertas.create') }}" class="btn btn-success">Nueva Oferta</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.productos.ofertas.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    @foreach ($estadosOferta as $estado)
                    <option value="{{ $estado->idEstadoOferta }}"
                        {{ request('estado') == $estado->idEstadoOferta ? 'selected' : '' }}>
                        {{ $estado->nombreEstado }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="tipo" class="form-select">
                    <option value="">Todos los tipos</option>
                    @foreach ($tiposOferta as $tipo)
                    <option value="{{ $tipo->idTipoOferta }}"
                        {{ request('tipo') == $tipo->idTipoOferta ? 'selected' : '' }}>
                        {{ $tipo->nombreTipo }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de ofertas -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Tipo de Oferta</th>
                <th>Valor</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->idProducto }}</td>
                <td>{{ $producto->nombreProducto }}</td>
                <td>{{ optional($producto->offerType)->nombreTipo ?? 'Sin tipo' }}</td>
                <td>{{ optional($producto->offerType)->nombreTipo === 'Porcentaje' ? $producto->valor_oferta . '%' : '$' . number_format($producto->valor_oferta, 2) }}
                </td>
                <td>{{ optional($producto->fecha_inicio_oferta)->format('Y-m-d') ?: '-' }}</td>
                <td>{{ optional($producto->fecha_fin_oferta)->format('Y-m-d') ?: '-' }}</td>
                <td>
                    <span
                        class="badge bg-{{ $producto->offerStatus?->nombreEstado == 'En oferta' ? 'success' : ($producto->offerStatus?->nombreEstado == 'Finalizada' ? 'danger' : 'secondary') }}">
                        {{ optional($producto->offerStatus)->nombreEstado ?? 'Sin oferta' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.productos.ofertas.show', $producto->idProducto) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.productos.ofertas.edit', $producto->idProducto) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.productos.ofertas.destroy', $producto->idProducto) }}" method="POST"
                        style="display:inline;" onsubmit="return confirm('¿Eliminar esta oferta?');">
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