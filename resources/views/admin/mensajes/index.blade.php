@extends('admin.layouts.app')

@section('title', 'Mensajes de Soporte')
@section('breadcrumbs')
@php
$breadcrumbs = [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Soporte']
];
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        @foreach ($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item">
            @if (isset($breadcrumb['url']))
            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
            @else
            <span>{{ $breadcrumb['name'] }}</span>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Listado -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Mensajes de Clientes</h5>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Asunto</th>
                                    <th>Mensaje</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $msg)
                                <tr class="{{ $msg->estado_mensaje === 'Abierto' ? 'fw-bold' : '' }}">
                                    <td>{{ $msg->id_mensaje }}</td>
                                    <td>{{ optional($msg->client)->nombres ?? 'Anónimo' }}</td>
                                    <td>{{ $msg->asunto }}</td>
                                    <td>{{ Str::limit($msg->mensaje, 30) }}</td>
                                    <td>{{ $msg->fecha_envio }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $msg->estado_mensaje === 'Abierto' ? 'primary' : ($msg->estado_mensaje === 'Respondido' ? 'warning' : 'secondary') }}">
                                            {{ $msg->estado_mensaje }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.mensajes.show', $msg->id_mensaje) }}"
                                            class="btn btn-sm btn-info">Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection