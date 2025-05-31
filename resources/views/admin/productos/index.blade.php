@extends('admin.layouts.app')

@section('title', 'Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
@endsection



@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Productos</h2>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-success">Nuevo Producto</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.productos.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="nombreProducto" class="form-control" placeholder="Buscar por nombre"
                    value="{{ request('nombreProducto') }}">
            </div>
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
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de productos -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->idProducto }}</td>
                <td>{{ $producto->nombreProducto }}</td>
                <td>{{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}</td>
                <td>${{ number_format($producto->precioProducto, 2) }}</td>
                <td>{{ optional($producto->productStatus)->estado ?? 'Desconocido' }}</td>
                <td>
                    <a href="{{ route('admin.productos.show', $producto->idProducto) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.productos.edit', $producto->idProducto) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto->idProducto) }}" method="POST"
                        style="display:inline;" onsubmit="return confirm('¿Eliminar este producto?');">
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