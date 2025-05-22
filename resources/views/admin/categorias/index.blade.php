@extends('admin.layouts.app')

@section('title', 'Categorías - Panel Admin')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Categorías']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Categorías</h2>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-success">Nueva Categoría</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.categorias.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" name="nombre_categoria" class="form-control"
                    placeholder="Buscar por nombre de categoría" value="{{ request('nombre_categoria') }}">
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de categorías -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad de Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id_categoria }}</td>
                <td>{{ $categoria->nombre_categoria }}</td>
                <td>{{ $categoria->descripcion ?: '-' }}</td>
                <td>{{ $categoria->products()->count() }}</td>
                <td>
                    <a href="{{ route('admin.categorias.show', $categoria->id_categoria) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.categorias.edit', $categoria->id_categoria) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST"
                        style="display:inline;" onsubmit="return confirm('¿Eliminar esta categoría?');">
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