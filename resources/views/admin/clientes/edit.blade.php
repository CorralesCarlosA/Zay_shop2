@extends('layouts.admin')

@section('title', 'Edición Completa de Cliente')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edición Completa - Cliente ID: {{ $client->n_identificacion}}</h3>
        </div>
        
        <form action="{{ route('admin.clientes.update', $client->n_identificacion) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card-body">
                <!-- Sección 1: Identificación -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h4 class="border-bottom pb-2" style="color: #d4af37;">
                            <i class="bi bi-person-badge"></i> Identificación
                        </h4>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>ID Cliente</label>
                            <input type="number" name="n_identificacion" class="form-control" 
                                   value="{{ old('n_identificacion', $client->n_identificacion) }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>DNI</label>
                            <input type="text" name="dni" class="form-control" 
                                   value="{{ old('dni', $client->dni) }}" required>
                        </div>
                    </div>
                    
                    <!-- ... otros campos de identificación ... -->
                </div>
                
                <!-- Sección 2: Datos Personales -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h4 class="border-bottom pb-2" style="color: #d4af37;">
                            <i class="bi bi-person-lines-fill"></i> Datos Personales
                        </h4>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" 
                                   value="{{ old('nombre', $client->nombres) }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" 
                                   value="{{ old('apellido', $client->apellidos) }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Sexo</label>
                            <select name="sexo" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="M" {{ old('sexo', $client->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo', $client->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('sexo', $client->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" 
                                   value="{{ old('fecha_nacimiento', optional($client->fecha_nacimiento)->format('Y-m-d') }}">
                        </div>
                    </div>
                    
                    <!-- ... más campos personales ... -->
                </div>
                
                <!-- Sección 3: Credenciales -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h4 class="border-bottom pb-2" style="color: #d4af37;">
                            <i class="bi bi-shield-lock"></i> Credenciales
                        </h4>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>correoE</label>
                            <input type="correoE" name="correoE" class="form-control" 
                                   value="{{ old('correoE', $client->correoE) }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nueva Contraseña</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                </div>
                
                <!-- ... otras secciones (ubicación, socio-económicos, etc.) ... -->
                
                <!-- Sección Final: Estado y Acciones -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control">
                                <option value="1" {{ old('estado', $client->estado) ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ !old('estado', $client->estado) ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    
                    @if($client->trashed())
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Restaurar Cliente</label>
                            <div class="form-check">
                                <input type="checkbox" name="restaurar" id="restaurar" class="form-check-input" value="1">
                                <label for="restaurar" class="form-check-label">Restaurar este cliente</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card-footer bg-light">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Guardar Cambios
                </button>
                
                <a href="{{ route('admin.clients.show', $client->n_identificacion) }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
                
                @if(!$client->trashed())
                <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash"></i> Desactivar Cliente
                </button>
                @else
                <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#forceDeleteModal">
                    <i class="bi bi-trash-fill"></i> Eliminar Permanentemente
                </button>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmación para eliminación -->
@include('admin.clients.modals.delete')
@endsection