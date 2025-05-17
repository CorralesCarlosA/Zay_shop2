@extends('admin.layouts.app')

@section('title', 'Productos - Panel Admin')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Productos']
])

@section('content')
<div class="container-fluid">
    <h2>Lista de Productos</h2>
    <p>Mostrando todos los productos disponibles.</p>

    <!-- Tabla de productos -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $producto)
            <tr>
                <td>{{ $producto->idProducto }}</td>
                <td>{{ $producto->nombreProducto }}</td>
                <td>${{ number_format($producto->precioProducto, 2) }}</td>
                <td>{{ optional($producto->inventory)->stock_actual ?? 0 }}</td>
                <td>{{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}</td>
                <td>
                    <a href="{{ route('admin.productos.show', $producto->idProducto) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.productos.edit', $producto->idProducto) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto->idProducto) }}" method="POST"
                        style="display:inline;">
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