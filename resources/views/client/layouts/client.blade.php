@extends('layouts.client')

@section('title', 'Iniciar Sesión - Cliente')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Inicio de Sesión</h3>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('client.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="n_identificacion" class="form-label">Identificación</label>
                    <input type="text" name="n_identificacion" id="n_identificacion" class="form-control" required
                        autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

            <p class="mt-3 text-center">
                ¿No tienes cuenta? <a href="{{ route('client.register') }}">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>
@endsection