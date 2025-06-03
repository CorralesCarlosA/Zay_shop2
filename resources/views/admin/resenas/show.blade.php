@extends('admin.layouts.app')

@section('title', 'Detalles de la Reseña #' . $reseña->id_reseña)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.resenas.index') }}">Reseñas</a></li>
    <li class="breadcrumb-item active">Detalle #{{ $reseña->id_reseña }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Reseña #{{ $reseña->id_reseña }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ optional($reseña->client)->nombres }}</p>
            <p><strong>Producto:</strong> {{ optional($reseña->product)->nombreProducto }}</p>
            <p><strong>Calificación:</strong>
            <div class="d-flex gap-1 fs-5 text-warning">
                @php
                for ($i = 1; $i <= 5; $i++) { echo $i <=$reseña->calificacion ? '★' : '☆';
                    }
                    @endphp
            </div>
            </p>
            <p><strong>Comentario:</strong> {{ $reseña->comentarios ?? 'Sin comentario' }}</p>
            <p><strong>Fecha:</strong> {{ $reseña->fecha_reseña }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.reseñas.edit', $reseña->id_reseña) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.reseñas.destroy', $reseña->id_reseña) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar este comentario?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection