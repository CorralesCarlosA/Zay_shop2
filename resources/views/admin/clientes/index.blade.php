<!-- resources/views/admin/clientes/index.blade.php -->

@extends('admin.layouts.app')

@section('title', 'Clientes - Panel Admin')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Clientes</h2>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-success">Nuevo Cliente</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Identificación</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->n_identificacion }}</td>
                <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                <td>{{ $cliente->tipo_identificacion }}</td>
                <td>{{ $cliente->correoE }}</td>
                <td>{{ $cliente->n_telefono }}</td>
                <td>{{ $cliente->Direccion_recidencia }}</td>
                <td>{{ $cliente->tipo_cliente }}</td>
                <td>
                    <a href="{{ route('admin.clientes.show', $cliente->n_identificacion) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.clientes.edit', $cliente->n_identificacion) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.clientes.destroy', $cliente->n_identificacion) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar este cliente?')" style="display:inline;">
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