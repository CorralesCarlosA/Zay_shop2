@extends('admin.layouts.app')

@section('title', 'Registrar Nuevo Administrador')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Registrar Admin']
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Registrar Nuevo Administrador</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.administradores.store') }}">
                        @csrf

                        <!-- Nombres -->
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" required>
                        </div>

                        <!-- Apellidos -->
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                        </div>

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="correoE" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correoE" id="correoE" class="form-control" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <!-- Rol del admin -->
                        <div class="mb-3">
                            <label for="id_rol_admin" class="form-label">Rol del Administrador</label>
                            <select name="id_rol_admin" id="id_rol_admin" class="form-select" required>
                                @foreach (\App\Models\admin\AdminRole::all() as $role)
                                <option value="{{ $role->id_rol_admin }}">{{ $role->nombre_rol }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de registro -->
                        <button type="submit" class="btn btn-success w-100">Registrar Administrador</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection