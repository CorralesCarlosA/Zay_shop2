@extends('layouts.admin')

@section('title', 'Recuperar Contraseña - Administrador')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Recuperar Contraseña</h4>
                    <p class="text-muted">Ingresa tu correo electrónico</p>
                </div>
                <div class="card-body p-4">

                    @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('client.password.send') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="correoE" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correoE" id="correoE" class="form-control" required autofocus>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Enviar Instrucciones</button>
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ route('client.login') }}" class="text-decoration-none">Volver al inicio de
                                sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection