@extends('admin.layouts.app')

@section('title', 'Marcas')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Marcas']
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Botón nuevo -->
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('admin.marcas.create') }}" class="btn btn-success">Nueva Marca</a>
        </div>

        <!-- Tabla de marcas -->
        <div class="col-md-12 mt-3">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5>Marcas Disponibles</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Productos</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcas as $marca)
                                <tr>
                                    <td>{{ $marca->id_marca }}</td>
                                    <td>{{ $marca->nombre_marca }}</td>
                                    <td><span class="badge bg-primary">{{ $marca->products_count ?? 0 }}</span></td>
                                    <td>
                                        {{ $marca->estado_marca ? 'Activo' : 'Inactivo' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.marcas.edit', $marca->id_marca) }}"
                                            class="btn btn-sm btn-outline-primary me-1">Editar</a>
                                        <form action="{{ route('admin.marcas.destroy', $marca->id_marca) }}"
                                            method="POST" onsubmit="return confirm('¿Eliminar esta marca?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection