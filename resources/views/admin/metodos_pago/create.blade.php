@extends('admin.layouts.app')

@section('title', 'Crear Método de Pago')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Métodos de Pago', 'url' => route('admin.metodos_pago.index')],
['name' => 'Nuevo']
])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Nuevo Método de Pago</h4>
                </div>
                <div class="card-body p-4">

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.metodos_pago.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Método</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Método</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">Selecciona tipo de método</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                <option value="PayU">PayU</option>
                                <option value="Mercado Pago">Mercado Pago</option>
                                <option value="PayPal">PayPal</option>
                                <option value="Nequi">Nequi</option>
                                <option value="Daviplata">Daviplata</option>
                                <option value="PSE">PSE</option>
                                <option value="QR">Código QR</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="activo" id="activo" class="form-check-input">
                            <label for="activo" class="form-check-label">Activo</label>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="configuracion_adicional" class="form-label">Configuración Adicional
                                (JSON)</label>
                            <textarea name="configuracion_adicional" id="configuracion_adicional" class="form-control"
                                rows="3" placeholder='{"public_key": "abc123", "private_key": "xyz789"}'></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="id_administrador" class="form-label">Administrador Responsable</label>
                            <select name="id_administrador" id="id_administrador" class="form-select" required>
                                <option value="">Selecciona un administrador</option>
                                @foreach ($admins as $admin)
                                <option value="{{ $admin->id_administrador }}">{{ $admin->nombres }}
                                    {{ $admin->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">Guardar Método</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection