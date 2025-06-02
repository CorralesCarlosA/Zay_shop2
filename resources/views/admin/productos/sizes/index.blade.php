@extends('admin.layouts.app')

@section('title', 'Tallas de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Tallas</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administración de Tallas</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createSizeModal">
            <i class="fas fa-plus-circle me-1"></i> Nueva Talla
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="sizesTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tallas as $talla)
                        <tr data-id="{{ $talla->id_talla }}">
                            <td>{{ $talla->id_talla }}</td>
                            <td>
                                <span class="view-mode">{{ $talla->nombre_talla }}</span>
                                <input type="text" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $talla->nombre_talla }}" data-field="nombre_talla">
                            </td>
                            <td>
                                <span class="view-mode">{{ $talla->descripcion ?? 'N/A' }}</span>
                                <input type="text" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $talla->descripcion }}" data-field="descripcion">
                            </td>
                            <td>
                                <div class="view-mode">
                                    <button class="btn btn-sm btn-warning edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.productos.tallas.destroy', $talla->id_talla) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Eliminar esta talla?')">
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

<!-- Modal para crear nueva talla -->
<div class="modal fade" id="createSizeModal" tabindex="-1" aria-labelledby="createSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.productos.tallas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSizeModalLabel">Nueva Talla</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_talla" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_talla" name="nombre_talla" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
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
            url: '/admin/productos/tallas/' + id,
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
