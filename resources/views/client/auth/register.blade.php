@extends('layouts.app')

@section('title', 'Registro de Cliente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Crear Cuenta</h4>
                    <p class="text-muted">Regístrate para empezar a comprar</p>
                </div>
                <div class="card-body p-4">

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('client.register') }}">
                        @csrf

                        <div class="row">
                            <!-- Nombres -->
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" name="nombres" id="nombres" class="form-control" required autofocus>
                            </div>

                            <!-- Apellidos -->
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                            </div>
                        </div>

                        <!-- Tipo de identificación -->
                        <div class="mb-3">
                            <label for="tipo_identificacion" class="form-label">Tipo de Identificación</label>
                            <select name="tipo_identificacion" id="tipo_identificacion" class="form-select" required>
                                <option value="">Selecciona un tipo</option>
                                <option value="Cedula de ciudadania (CC)">Cédula de Ciudadanía (CC)</option>
                                <option value="Tarjeta de identidad (TI)">Tarjeta de Identidad (TI)</option>
                                <option value="NIT">NIT</option>
                                <option value="Pasaporte (CE)">Pasaporte (CE)</option>
                            </select>
                        </div>

                        <!-- Número de identificación -->
                        <div class="mb-3">
                            <label for="n_identificacion" class="form-label">Número de Identificación</label>
                            <input type="text" name="n_identificacion" id="n_identificacion" class="form-control"
                                required>
                        </div>

                        <!-- Correo electrónico -->
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

                        <div class="row">
                            <!-- Teléfono -->
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" required>
                            </div>

                            <!-- Dirección -->
                            <div class="col-md-6 mb-3">
                                <label for="Direccion_recidencia" class="form-label">Dirección de Residencia</label>
                                <input type="text" name="Direccion_recidencia" id="Direccion_recidencia"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Sexo -->
                            <div class="col-md-6 mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select name="sexo" id="sexo" class="form-select" required>
                                    <option value="">Selecciona tu género</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <!-- Estatura -->
                            <div class="col-md-6 mb-3">
                                <label for="estatura_m" class="form-label">Estatura (m)</label>
                                <input type="number" step="0.01" min="0.5" max="2.5" name="estatura_m" id="estatura_m"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- Ciudad -->
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <select name="ciudad" id="ciudad" class="form-select" required>
                                <option value="">Selecciona tu ciudad</option>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de registro -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">Registrar Cuenta</button>
                        </div>

                        <!-- Enlace a login -->
                        <div class="mt-3 text-center">
                            <p class="mb-0">¿Ya tienes cuenta? <a href="{{ route('client.login') }}"
                                    class="text-decoration-none">Inicia Sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection