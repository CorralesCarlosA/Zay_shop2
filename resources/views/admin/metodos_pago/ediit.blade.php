@extends('admin.layouts.app')

@section('title', 'Editar Método de Pago #' . $metodoPago->id_metodo_pago)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Métodos de Pago', 'url' => route('admin.metodos_pago.index')],
['name' => 'Editar #' . $metodoPago->id_metodo_pago]
])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h4>Editar Método de Pago</h4>
                </div>
                <div class="card-body p-4">

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.metodos_pago.update', $metodoPago->id_metodo_pago) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Método</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                value="{{ old('nombre', $metodoPago->nombre) }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Método</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">Selecciona tipo de método</option>
                                <option value="Efectivo"
                                    {{ old('tipo', $metodoPago->tipo) == 'Efectivo' ? 'selected' : '' }}>Efectivo (Solo
                                    tienda física)</option>
                                <option value="Tarjeta"
                                    {{ old('tipo', $metodoPago->tipo) == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                <option value="Transferencia Bancaria"
                                    {{ old('tipo', $metodoPago->tipo) == 'Transferencia Bancaria' ? 'selected' : '' }}>
                                    Transferencia Bancaria</option>
                                <option value="PayU" {{ old('tipo', $metodoPago->tipo) == 'PayU' ? 'selected' : '' }}>
                                    PayU</option>
                                <option value="Mercado Pago"
                                    {{ old('tipo', $metodoPago->tipo) == 'Mercado Pago' ? 'selected' : '' }}>Mercado
                                    Pago</option>
                                <option value="PayPal"
                                    {{ old('tipo', $metodoPago->tipo) == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                                <option value="Nequi" {{ old('tipo', $metodoPago->tipo) == 'Nequi' ? 'selected' : '' }}>
                                    Nequi</option>
                                <option value="Daviplata"
                                    {{ old('tipo', $metodoPago->tipo) == 'Daviplata' ? 'selected' : '' }}>Daviplata
                                </option>
                                <option value="PSE" {{ old('tipo', $metodoPago->tipo) == 'PSE' ? 'selected' : '' }}>PSE
                                </option>
                                <option value="QR" {{ old('tipo', $metodoPago->tipo) == 'QR' ? 'selected' : '' }}>Código
                                    QR</option>
                                <option value="Otro" {{ old('tipo', $metodoPago->tipo) == 'Otro' ? 'selected' : '' }}>
                                    Otro</option>
                            </select>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="activo" id="activo" class="form-check-input"
                                {{ old('activo', $metodoPago->activo) ? 'checked' : '' }}>
                            <label for="activo" class="form-check-label">Activo</label>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"
                                rows="3">{{ old('descripcion', $metodoPago->descripcion) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="configuracion_adicional" class="form-label">Configuración Adicional
                                (JSON)</label>
                            <textarea name="configuracion_adicional" id="configuracion_adicional" class="form-control"
                                rows="3"
                                placeholder='{"public_key": "abc123", "private_key": "xyz789"}'>{{ old('configuracion_adicional', $metodoPago->configuracion_adicional ?? '') }}</textarea>
                            <small class="form-text text-muted">
                                Ejemplo: <code>{"api_key": "tu_clave_aqui", "modo_prueba": true}</code>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="id_administrador" class="form-label">Administrador Responsable</label>
                            <select name="id_administrador" id="id_administrador" class="form-select" required>
                                <option value="">Selecciona un administrador</option>
                                @foreach ($admins as $admin)
                                <option value="{{ $admin->id_administrador }}"
                                    {{ old('id_administrador', $metodoPago->id_administrador) == $admin->id_administrador ? 'selected' : '' }}>
                                    {{ $admin->nombres }} {{ $admin->apellidos }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar Método</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection