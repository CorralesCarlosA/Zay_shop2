@extends('admin.layouts.app')

@section('title', 'Colores de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Colores</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administración de Colores</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createColorModal">
            <i class="fas fa-plus-circle me-1"></i> Nuevo Color
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="colorsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Código Color</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colores as $color)
                        <tr data-id="{{ $color->idColor }}">
                            <td>{{ $color->idColor }}</td>
                            <td>
                                <span class="view-mode">{{ $color->nombreColor }}</span>
                                <input type="text" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $color->nombreColor }}" data-field="nombreColor">
                            </td>
                            <td>
                                <span class="view-mode">
                                    <span class="color-preview" style="background-color: {{ $color->codigoColor ?? '#ccc' }}"></span>
                                </span>
                                <input type="color" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $color->codigoColor ?? '#cccccc' }}" data-field="codigoColor">
                            </td>
                            <td>
                                <div class="view-mode">
                                    <button class="btn btn-sm btn-warning edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.productos.colores.destroy', $color->idColor) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Eliminar este color?')">
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

<!-- Modal para crear nuevo color -->
<div class="modal fade" id="createColorModal" tabindex="-1" aria-labelledby="createColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.productos.colores.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createColorModalLabel">Nuevo Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreColor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreColor" name="nombreColor" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigoColor" class="form-label">Código Color</label>
                        <input type="color" class="form-control form-control-color" id="codigoColor" name="codigoColor">
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
.color-preview {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #ddd;
    vertical-align: middle;
    margin-right: 8px;
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
            url: '/admin/productos/colores/' + id,
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
