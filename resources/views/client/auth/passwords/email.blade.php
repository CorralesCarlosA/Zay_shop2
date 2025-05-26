@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Recuperar Contraseña</h4>
                </div>
                <div class="card-body p-4">

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
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

                        <div class="mt-3 text-center">
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