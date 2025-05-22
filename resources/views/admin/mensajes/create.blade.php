@extends('admin.layouts.app')

@section('title', 'Nuevo Mensaje')
@section('breadcrumbs')
@php
$breadcrumbs = [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Soporte', 'url' => route('admin.mensajes.index')],
['name' => 'Nuevo']
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
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4>Crear Nuevo Mensaje</h4>

                    <form method="POST" action="{{ route('admin.mensajes.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select name="n_identificacion_cliente" id="cliente" class="form-select" required>
                                <option value="">Selecciona un cliente</option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->n_identificacion }}">
                                    {{ $client->nombres }} ({{ $client->correoE }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" name="asunto" id="asunto" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea name="mensaje" id="mensaje" class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection