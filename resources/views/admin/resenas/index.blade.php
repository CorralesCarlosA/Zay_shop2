@extends('admin.layouts.app')

@section('title', 'Reseñas de Productos')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Reseñas']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Reseñas</h2>
        <a href="{{ route('admin.reseñas.create') }}" class="btn btn-success">Agregar Manualmente</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.reseñas.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="cliente" class="form-control" placeholder="Buscar por cliente"
                    value="{{ request('cliente') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="producto" class="form-control" placeholder="Buscar por producto"
                    value="{{ request('producto') }}">
            </div>
            <div class="col-md-3">
                <select name="calificacion" class="form-select">
                    <option value="">Todas las calificaciones</option>
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">Calificación {{ $i }} ⭐</option>
                        @endfor
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de reseñas -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Calificación</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reseñas as $reseña)
            <tr>
                <td>{{ $reseña->id_reseña }}</td>
                <td>{{ optional($reseña->client)->nombres ?? 'Desconocido' }}</td>
                <td>{{ optional($reseña->product)->nombreProducto ?? 'Producto no encontrado' }}</td>
                <td>
                    <div class="d-flex gap-1">
                        @for ($i = 1; $i <= 5; $i++) <span
                            class="text-{{ $i <= $reseña->calificacion ? 'warning' : 'muted' }}">★</span>
                            @endfor
                    </div>
                </td>
                <td>{{ $reseña->fecha_reseña }}</td>
                <td>
                    <a href="{{ route('admin.reseñas.show', $reseña->id_reseña) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.reseñas.edit', $reseña->id_reseña) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.reseñas.destroy', $reseña->id_reseña) }}" method="POST"
                        style="display:inline;" onsubmit="return confirm('¿Eliminar esta reseña?');">
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