@extends('admin.layouts.app')

@section('title', 'Favoritos')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Favoritos']
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Listado -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Favoritos</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favoritos as $favorito)
                                <tr>
                                    <td>{{ $favorito->id_favorito }}</td>
                                    <td>{{ optional($favorito->client)->nombres ?? 'Anónimo' }}</td>
                                    <td>{{ optional($favorito->product)->nombreProducto ?? 'Producto no encontrado' }}
                                    </td>
                                    <td>{{ $favorito->fecha_agregado }}</td>
                                    <td>
                                        <form action="{{ route('admin.favoritos.destroy', $favorito->id_favorito) }}"
                                            method="POST" onsubmit="return confirm('¿Eliminar de favoritos?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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