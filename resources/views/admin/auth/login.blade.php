@extends('layouts.admin')

@section('title', 'Inicio de Sesión - Admin')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white text-center">
                <h4>Mi Tienda - Admin</h4>
                <p class="text-white mb-0">Panel de administración</p>
            </div>
            <div class="card-body p-4">

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="correoE" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correoE" id="correoE" class="form-control"
                            placeholder="ejemplo@dominio.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection