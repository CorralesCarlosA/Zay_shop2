@extends('admin.layouts.app')

@section('title', 'Métodos de Pago')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Métodos de Pago', 'url' => route('admin.metodos_pago.index')]
])

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Métodos de Pago</h4>
        <a href="{{ route('admin.metodos_pago.create') }}" class="btn btn-success">Nuevo Método</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($metodosPago as $metodo)
                    <tr>
                        <td>{{ $metodo->id_metodo_pago }}</td>
                        <td>{{ $metodo->nombre }}</td>
                        <td><span class="badge bg-info">{{ $metodo->tipo }}</span></td>
                        <td>{{ $metodo->activo ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admin.metodos_pago.edit', $metodo->id_metodo_pago) }}"
                                class="btn btn-sm btn-outline-primary me-1">Editar</a>
                            <form action="{{ route('admin.metodos_pago.destroy', $metodo->id_metodo_pago) }}"
                                method="POST" onsubmit="return confirm('¿Eliminar este método?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection