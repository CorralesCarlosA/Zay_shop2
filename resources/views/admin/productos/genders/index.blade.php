@extends('admin.layouts.app')

@section('title', 'Géneros de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Géneros</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administración de Géneros</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createGenderModal">
            <i class="fas fa-plus-circle me-1"></i> Nuevo Género
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="gendersTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($generos as $genero)
                        <tr data-id="{{ $genero->idSexoProducto }}">
                            <td>{{ $genero->idSexoProducto }}</td>
                            <td>
                                <span class="view-mode">{{ $genero->nombreSexo }}</span>
                                <input type="text" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $genero->nombreSexo }}" data-field="nombreSexo">
                            </td>
                            <td>
                                <div class="view-mode">
                                    <button class="btn btn-sm btn-warning edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.productos.generos.destroy', $genero->idSexoProducto) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Eliminar este género?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="edit-mode d-none">
                                    <button class="btn btn-sm btn-success save-btn">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-secondary cancel-btn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear nuevo género -->
<div class="modal fade" id="createGenderModal" tabindex="-1" aria-labelledby="createGenderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.productos.generos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createGenderModalLabel">Nuevo Género</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreSexo" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreSexo" name="nombreSexo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Activar modo edición
    $('.edit-btn').click(function() {
        const row = $(this).closest('tr');
        row.find('.view-mode').addClass('d-none');
        row.find('.edit-mode').removeClass('d-none');
    });

    // Cancelar edición
    $('.cancel-btn').click(function() {
        const row = $(this).closest('tr');
        row.find('.edit-mode').addClass('d-none');
        row.find('.view-mode').removeClass('d-none');
    });

    // Guardar cambios
    $('.save-btn').click(function() {
        const row = $(this).closest('tr');
        const id = row.data('id');
        const data = {
            _token: '{{ csrf_token() }}',
            _method: 'PUT'
        };

        row.find('.edit-mode input').each(function() {
            data[$(this).data('field')] = $(this).val();
        });

        $.ajax({
            url: '/admin/productos/generos/' + id,
            type: 'POST',
            data: data,
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Error al actualizar: ' + xhr.responseText);
            }
        });
    });
});
</script>
@endpush

