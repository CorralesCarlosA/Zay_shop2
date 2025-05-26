@extends('layouts.app')

@section('title', 'Iniciar Sesión - Cliente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Iniciar Sesión</h4>
                    <p class="text-muted">Bienvenido de nuevo al sistema</p>
                </div>
                <div class="card-body p-4">

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('client.login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="correoE" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correoE" id="correoE" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ route('client.register.form') }}" class="text-decoration-none">¿No tienes
                                cuenta? Regístrate</a>
                            <a href="{{ route('client.password.email') }}" class="text-decoration-none">¿Olvidaste tu
                                contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection