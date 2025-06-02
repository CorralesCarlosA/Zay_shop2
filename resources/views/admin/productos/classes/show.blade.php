@extends('admin.layouts.app')

@section('title', 'Detalles de Clase de Producto')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.productos.classes.index') }}">Clases de Producto</a></li>
    <li class="breadcrumb-item active">Detalles</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detalles de Clase: {{ $clase->nombreClase }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Información Básica</h6>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>ID:</strong> {{ $clase->idClaseProducto }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Nombre:</strong> {{ $clase->nombreClase }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Productos asociados:</strong> {{ $clase->products->count() }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($clase->products->count() > 0)
                    <div class="mt-4">
                        <h6>Productos en esta clase</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clase->products as $producto)
                                    <tr>
                                        <td>{{ $producto->idProducto }}</td>
                                        <td>{{ $producto->nombreProducto }}</td>
                                        <td>${{ number_format($producto->precioProducto, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $producto->status->estado == 'Disponible' ? 'success' : 'warning' }}">
                                                {{ $producto->status->estado ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.productos.edit', $producto->idProducto) }}" 
                                               class="btn btn-sm btn-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('admin.productos.classes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection