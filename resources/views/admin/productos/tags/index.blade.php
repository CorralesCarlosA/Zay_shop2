@extends('admin.layouts.app')

@section('title', 'Etiquetas de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Etiquetas</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administración de Etiquetas</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTagModal">
            <i class="fas fa-plus-circle me-1"></i> Nueva Etiqueta
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tagsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etiquetas as $etiqueta)
                        <tr data-id="{{ $etiqueta->id_etiqueta }}">
                            <td>{{ $etiqueta->id_etiqueta }}</td>
                            <td>
                                <span class="view-mode">{{ $etiqueta->nombre_etiqueta }}</span>
                                <input type="text" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $etiqueta->nombre_etiqueta }}" data-field="nombre_etiqueta">
                            </td>
                            <td>
                                <span class="view-mode">
                                    <span class="badge" style="background-color: {{ $etiqueta->color ?? '#6c757d' }};">
                                        {{ $etiqueta->color ?? 'Sin color' }}
                                    </span>
                                </span>
                                <input type="color" class="edit-mode form-control form-control-color d-none" 
                                       value="{{ $etiqueta->color ?? '#6c757d' }}" data-field="color">
                            </td>
                            <td>
                                <div class="view-mode">
                                    <button class="btn btn-sm btn-warning edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.productos.etiquetas.destroy', $etiqueta->id_etiqueta) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Eliminar esta etiqueta?')">
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

<!-- Modal para crear nueva etiqueta -->
<div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.productos.etiquetas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createTagModalLabel">Nueva Etiqueta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_etiqueta" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_etiqueta" name="nombre_etiqueta" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" value="#6c757d">
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

@push('styles')
<style>
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    color: white;
}
</style>
@endpush

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
            url: '/admin/productos/etiquetas/' + id,
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
