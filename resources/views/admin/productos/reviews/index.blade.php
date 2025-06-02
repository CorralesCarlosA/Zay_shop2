@extends('admin.layouts.app')

@section('title', 'Comentarios de Productos - Panel Admin')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Productos</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Comentarios</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administración de Comentarios</h2>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filtrar por estado
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.productos.comentarios.index') }}">Todos</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.productos.comentarios.index', ['estado' => 'Pendiente']) }}">Pendientes</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.productos.comentarios.index', ['estado' => 'Aprobada']) }}">Aprobados</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.productos.comentarios.index', ['estado' => 'Rechazada']) }}">Rechazados</a></li>
            </ul>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="reviewsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cliente</th>
                            <th>Calificación</th>
                            <th>Comentario</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comentarios as $comentario)
                        <tr data-id="{{ $comentario->id_reseña }}">
                            <td>{{ $comentario->id_reseña }}</td>
                            <td>
                                <a href="{{ route('admin.productos.show', $comentario->idProducto) }}">
                                    {{ $comentario->producto->nombreProducto }}
                                </a>
                            </td>
                            <td>{{ $comentario->cliente->nombre ?? 'Cliente eliminado' }}</td>
                            <td>
                                <div class="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $comentario->calificacion ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td>{{ Str::limit($comentario->comentario, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $comentario->estado_reseña == 'Pendiente' ? 'warning' : 
                                    ($comentario->estado_reseña == 'Aprobada' ? 'success' : 'danger') 
                                }}">
                                    {{ $comentario->estado_reseña }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $comentario->id_reseña }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($comentario->estado_reseña == 'Pendiente')
                                    <form action="{{ route('admin.productos.comentarios.approve', $comentario->id_reseña) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success" title="Aprobar">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.productos.comentarios.reject', $comentario->id_reseña) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" title="Rechazar">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal para ver detalles -->
                        <div class="modal fade" id="reviewModal{{ $comentario->id_reseña }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detalles del Comentario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <h6>Producto:</h6>
                                            <p>{{ $comentario->producto->nombreProducto }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Cliente:</h6>
                                            <p>{{ $comentario->cliente->nombre ?? 'Cliente eliminado' }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Calificación:</h6>
                                            <div class="star-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $comentario->calificacion ? 'text-warning' : 'text-secondary' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Comentario:</h6>
                                            <p>{{ $comentario->comentario }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Fecha:</h6>
                                            <p>{{ $comentario->fecha_reseña->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Estado:</h6>
                                            <span class="badge bg-{{ 
                                                $comentario->estado_reseña == 'Pendiente' ? 'warning' : 
                                                ($comentario->estado_reseña == 'Aprobada' ? 'success' : 'danger') 
                                            }}">
                                                {{ $comentario->estado_reseña }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        @if($comentario->estado_reseña == 'Pendiente')
                                        <form action="{{ route('admin.productos.comentarios.approve', $comentario->id_reseña) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check me-1"></i> Aprobar
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.productos.comentarios.reject', $comentario->id_reseña) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-times me-1"></i> Rechazar
                                            </button>
                                        </form>
                                        @endif
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $comentarios->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.star-rating {
    color: #ffc107;
    font-size: 1rem;
}
</style>
@endpush