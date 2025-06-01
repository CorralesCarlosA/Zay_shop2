<!-- resources/views/admin/clientes/show.blade.php -->

@extends('admin.layouts.app')

@section('title', 'Detalles del Cliente')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.clientes.index') }}">Clientes</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Detalles</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Detalles del Cliente: {{ $client->nombres }} {{ $client->apellidos }}</h3>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="border-bottom pb-2 text-primary">
                        <i class="bi bi-person-badge"></i> Información Básica
                    </h4>
                </div>
                
                <div class="col-md-4">
                    <p><strong>Identificación:</strong> {{ $client->n_identificacion }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Tipo:</strong> {{ $client->tipo_identificacion }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Estado:</strong> 
                        @if($client->estado_cliente)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="border-bottom pb-2 text-primary">
                        <i class="bi bi-person-lines-fill"></i> Datos Personales
                    </h4>
                </div>
                
                <div class="col-md-4">
                    <p><strong>Nombres:</strong> {{ $client->nombres }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Apellidos:</strong> {{ $client->apellidos }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Sexo:</strong> {{ $client->sexo }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Fecha Nacimiento:</strong> {{ $client->fecha_nacimiento ? $client->fecha_nacimiento->format('d/m/Y') : 'N/A' }}</p>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="border-bottom pb-2 text-primary">
                        <i class="bi bi-geo-alt"></i> Información de Contacto
                    </h4>
                </div>
                
                <div class="col-md-4">
                    <p><strong>Correo:</strong> {{ $client->correoE }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Teléfono:</strong> {{ $client->n_telefono }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Dirección:</strong> {{ $client->Direccion_recidencia }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Ciudad:</strong> {{ $client->ciudad }}</p>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="border-bottom pb-2 text-primary">
                        <i class="bi bi-calendar"></i> Datos del Sistema
                    </h4>
                </div>
                
                <div class="col-md-4">
                    <p><strong>Fecha Registro:</strong> {{ $client->fecha_registro->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Tipo Cliente:</strong> {{ $client->tipo_cliente }}</p>
                </div>
                @if($client->deleted_at)
                <div class="col-md-4">
                    <p><strong>Eliminado el:</strong> {{ $client->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>
        </div>
        
        <div class="card-footer bg-light">
            <a href="{{ route('admin.clientes.edit', $client->n_identificacion) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
            
            <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            
            @if(!$client->trashed())
            <form action="{{ route('admin.clientes.destroy', $client->n_identificacion) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger float-end" onclick="return confirm('¿Desactivar este cliente?')">
                    <i class="bi bi-trash"></i> Desactivar
                </button>
            </form>
            @else
            <form action="{{ route('admin.clientes.restore', $client->n_identificacion) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('¿Restaurar este cliente?')">
                    <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection