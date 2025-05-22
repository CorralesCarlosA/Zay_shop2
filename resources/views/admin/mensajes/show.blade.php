@extends('admin.layouts.app')

@section('title', 'Mensaje #' . $mensaje->id_mensaje)
@section('breadcrumbs')
@php
$breadcrumbs = [
['name' => 'Soporte', 'url' => route('admin.mensajes.index')],
['name' => 'Detalle #' . $mensaje->id_mensaje]
];
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        @foreach ($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item">
            @if (isset($breadcrumb['url']))
            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
            @else
            {{ $breadcrumb['name'] }}
            @endif
        </li>
        @endforeach
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5>Mensaje #{{ $mensaje->id_mensaje }}</h5>
            @unless($mensaje->estado_mensaje === 'Cerrado')
            <form action="{{ route('admin.mensajes.update', $mensaje->id_mensaje) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="estado_mensaje" value="Cerrado">
                <button type="submit" class="btn btn-success btn-sm">Marcar como Respondido</button>
            </form>
            @endunless
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ optional($mensaje->client)->nombres ?? 'Desconocido' }}</p>
            <p><strong>Email:</strong> {{ optional($mensaje->client)->correoE ?? 'No disponible' }}</p>
            <p><strong>Fecha:</strong> {{ $mensaje->fecha_envio }} - {{ $mensaje->hora_envio }}</p>
            <hr>
            <p><strong>Mensaje:</strong></p>
            <p>{{ $mensaje->mensaje }}</p>

            @if ($mensaje->respuesta)
            <hr>
            <p><strong>Respuesta:</strong></p>
            <p>{{ $mensaje->respuesta }}</p>
            @endif
        </div>
    </div>
</div>
@endsection