@extends('client.layouts.app')

@section('title', 'Registrarse - Cliente')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('welcome')],
['name' => 'Registrarse']
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Crear Cuenta de Cliente</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('client.register') }}">
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

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="n_telefono" class="form-label">Teléfono</label>
                            <input type="text" name="n_telefono" id="n_telefono" class="form-control" required>
                        </div>

                        <!-- Sexo -->
                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select name="sexo" id="sexo" class="form-select" required>
                                <option value="">Selecciona tu sexo</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="Direccion_recidencia" class="form-label">Dirección</label>
                            <input type="text" name="Direccion_recidencia" id="Direccion_recidencia"
                                class="form-control" required>
                        </div>

                        <!-- Ciudad -->
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <select name="ciudad" id="ciudad" class="form-select" required>
                                @foreach (\App\Models\admin\City::all() as $city)
                                <option value="{{ $city->id_ciudad }}">{{ $city->nombre_ciudad }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de registro -->
                        <button type="submit" class="btn btn-success w-100">Crear Cuenta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection