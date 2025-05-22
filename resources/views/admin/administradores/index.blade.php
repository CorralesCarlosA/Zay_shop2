<!-- admin/administradores/index.blade.php -->

@extends('admin.layouts.app')

@section('title', 'Administradores')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Administradores']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Administradores</h2>
        <a href="{{ route('admin.administradores.create') }}" class="btn btn-success">Nuevo Administrador</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id_administrador }}</td>
                <td>{{ $admin->nombres }} {{ $admin->apellidos }}</td>
                <td>{{ $admin->correoE }}</td>
                <td>{{ optional($admin->role)->nombre_rol ?? 'Sin rol' }}</td>
                <td>
                    <a href="{{ route('admin.administradores.show', $admin->id_administrador) }}"
                        class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.administradores.edit', $admin->id_administrador) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.administradores.destroy', $admin->id_administrador) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar este administrador?');">
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