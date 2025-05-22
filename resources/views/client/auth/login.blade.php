@extends('client.layouts.app')

@section('title', 'Iniciar Sesión - Cliente')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('welcome')],
['name' => 'Iniciar Sesión']
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Iniciar Sesión</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('client.login') }}">
                        @csrf

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="correoE" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correoE" id="correoE" class="form-control" required autofocus>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- Recordarme -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Mantener sesión iniciada</label>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>

                    <hr>

                    <p class="text-center mt-3">
                        ¿No tienes cuenta?
                        <a href="{{ route('client.register.form') }}" class="text-decoration-none">Regístrate aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection