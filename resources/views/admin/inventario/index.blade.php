@extends('admin.layouts.app')

@section('title', 'Gestión de Inventario')
@section('breadcrumbs', [
    ['name' => 'Inicio', 'url' => route('admin.dashboard')],
    ['name' => 'Inventario', 'url' => route('admin.inventario.index')]
])

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Inventario</h2>
        <a href="{{ route('admin.inventario.create') }}" class="btn btn-success">Nuevo Inventario</a>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.inventario.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <select name="producto" id="producto" class="form-select">
                    <option value="">Todos los productos</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->idProducto }}" {{ request('producto') == $producto->idProducto ? 'selected' : '' }}>
                            {{ $producto->nombreProducto }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="stock" id="stock" class="form-select">
                    <option value="">Filtrar por stock</option>
                    <option value="bajo" {{ request('stock') == 'bajo' ? 'selected' : '' }}>Stock Bajo</option>
                    <option value="suficiente" {{ request('stock') == 'suficiente' ? 'selected' : '' }}>Stock Suficiente</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.inventario.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
            </div>
        </div>
    </form>

    <!-- Tabla de inventario -->
    @if ($inventarios->isNotEmpty())
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Stock Actual</th>
                <th>Stock Mínimo</th>
                <th>Última Actualización</th>
                <th>Administrador</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventarios as $item)
            <tr>
                <td>{{ $item->id_inventario }}</td>
                <td>{{ optional($item->product)->nombreProducto ?? 'Producto no encontrado' }}</td>
                <td><span class="badge bg-{{ $item->stock_actual <= $item->stock_minimo ? 'danger' : 'success' }}">
                    {{ $item->stock_actual }}
                </span></td>
                <td>{{ $item->stock_minimo }}</td>
                <td>{{ \Carbon\Carbon::parse($item->fecha_actualizacion)->format('d/m/Y H:i') }}</td>
                <td>{{ optional($item->admin)->nombres ?? 'Sin asignar' }}</td>
                <td>
                    <a href="{{ route('admin.inventario.edit', $item->id_inventario) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                    <form action="{{ route('admin.inventario.destroy', $item->id_inventario) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este inventario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-muted text-center my-4">No hay registros de inventario.</p>
    @endif
</div>
@endsection