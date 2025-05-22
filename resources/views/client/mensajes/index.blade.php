@extends('client.layouts.app')

@section('title', 'Mensajes de Soporte')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Mensajes']
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Mensajes de Soporte</h5>
        </div>
        <div class="card-body">

            @if ($mensajes->isEmpty())
            <div class="alert alert-info">No tienes mensajes pendientes.</div>
            @else
            <div class="list-group">
                @foreach ($mensajes as $mensaje)
                <a href="{{ route('client.mensajes.show', $mensaje->id_mensaje) }}"
                    class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $mensaje->asunto }}</h5>
                        <small>{{ $mensaje->fecha_envio }}</small>
                    </div>
                    <p class="mb-1">{{ Str::limit($mensaje->mensaje, 50) }}</p>
                    <span class="badge bg-{{ $mensaje->estado_mensaje === 'Abierto' ? 'primary' : 'success' }}">
                        {{ $mensaje->estado_mensaje }}
                    </span>
                </a>
                @endforeach
            </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('client.mensajes.create') }}" class="btn btn-success w-100">Nuevo Mensaje</a>
            </div>
        </div>
    </div>
</div>
@endsection