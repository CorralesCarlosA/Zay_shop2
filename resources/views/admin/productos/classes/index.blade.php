@extends('admin.layouts.app')

@section('title', 'Clases de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Clases</li>
@endsection

@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <h2>Listado de Clases de Producto</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clases as $clase)
                    <tr>
                        <td>{{ $clase->idClaseProducto }}</td>
                        <td>{{ $clase->clase }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            url: '/admin/productos/clases/' + id,
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