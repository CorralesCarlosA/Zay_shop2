@extends('admin.layouts.app')

@section('title', 'Inventario - Panel Admin')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Inventario']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Inventario</h2>
        <a href="{{ route('admin.inventario.create') }}" class="btn btn-success">Nuevo Registro</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.inventario.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="producto" class="form-control" placeholder="Buscar por nombre de producto"
                    value="{{ request('producto') }}">
            </div>
            <div class="col-md-4">
                <input type="number" name="stock_minimo" class="form-control" placeholder="Stock mínimo"
                    value="{{ request('stock_minimo') }}">
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de inventario -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
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
            @foreach ($inventarios as $inventario)
            <tr>
                <td>{{ $inventario->id_inventario }}</td>
                <td>{{ optional($inventario->product)->nombreProducto ?? 'Producto no encontrado' }}</td>
                <td>{{ $inventario->stock_actual }}</td>
                <td>{{ $inventario->stock_minimo }}</td>
                <td>{{ $inventario->fecha_actualizacion }}</td>
                <td>{{ optional($inventario->admin)->nombres ?? 'Admin no encontrado' }}</td>
                <td>
                    <a href="{{ route('admin.inventario.show', $inventario->id_inventario) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.inventario.edit', $inventario->id_inventario) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.inventario.destroy', $inventario->id_inventario) }}" method="POST"
                        style="display:inline;" onsubmit="return confirm('¿Eliminar este registro?');">
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