@extends('admin.layouts.app')

@section('title', 'Marcas de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Marcas</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administración de Marcas</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createBrandModal">
            <i class="fas fa-plus-circle me-1"></i> Nueva Marca
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="brandsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marcas as $marca)
                        <tr data-id="{{ $marca->id_marca }}">
                            <td>{{ $marca->id_marca }}</td>
                            <td>
                                <span class="view-mode">{{ $marca->nombre_marca }}</span>
                                <input type="text" class="edit-mode form-control form-control-sm d-none" 
                                       value="{{ $marca->nombre_marca }}" data-field="nombre_marca">
                            </td>
                            <td>
                                <span class="view-mode">{{ Str::limit($marca->descripcion, 50) }}</span>
                                <textarea class="edit-mode form-control form-control-sm d-none" 
                                          data-field="descripcion">{{ $marca->descripcion }}</textarea>
                            </td>
                            <td>
                                <span class="view-mode">
                                    <span class="badge bg-{{ $marca->estado_marca ? 'success' : 'secondary' }}">
                                        {{ $marca->estado_marca ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </span>
                                <select class="edit-mode form-select form-select-sm d-none" data-field="estado_marca">
                                    <option value="1" {{ $marca->estado_marca ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ !$marca->estado_marca ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </td>
                            <td>
                                <div class="view-mode">
                                    <button class="btn btn-sm btn-warning edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.productos.marcas.destroy', $marca->id_marca) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Eliminar esta marca?')">
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

<!-- Modal para crear nueva marca -->
<div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.productos.marcas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createBrandModalLabel">Nueva Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_marca" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_marca" name="nombre_marca" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="estado_marca" name="estado_marca" value="1" checked>
                        <label class="form-check-label" for="estado_marca">Activo</label>
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

        row.find('.edit-mode input, .edit-mode select, .edit-mode textarea').each(function() {
            const field = $(this).data('field');
            data[field] = $(this).is('select, input[type="checkbox"]') ? $(this).val() : $(this).val();
        });

        $.ajax({
            url: '/admin/productos/marcas/' + id,
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