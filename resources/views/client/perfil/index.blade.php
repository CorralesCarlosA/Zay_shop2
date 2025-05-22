<!-- client/perfil/index.blade.php -->
@extends('client.layouts.app')

@section('title', 'Mi Perfil')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Mi Perfil']
])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Mi Perfil</h4>
                </div>
                <div class="card-body">

                    <p><strong>Nombres:</strong> {{ $cliente->nombres }}</p>
                    <p><strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>
                    <p><strong>Teléfono:</strong> {{ $cliente->n_telefono }}</p>
                    <p><strong>Dirección:</strong> {{ $cliente->Direccion_recidencia }}</p>
                    <p><strong>Ciudad:</strong> {{ optional($cliente->city)->nombre_ciudad }}</p>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('client.perfil.edit') }}" class="btn btn-warning">Editar Datos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection