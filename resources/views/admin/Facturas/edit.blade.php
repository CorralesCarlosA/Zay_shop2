@extends('admin.layouts.app')

@section('title', 'Editar Factura #' . $factura->id_factura)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Facturas', 'url' => route('admin.facturas.index')],
['name' => 'Editar Factura #' . $factura->id_factura]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Editar Factura #{{ $factura->id_factura }}</h4>

                    <form method="POST" action="{{ route('admin.facturas.update', $factura->id_factura) }}">
                        @csrf
                        @method('PUT')

                        <!-- Datos del cliente -->
                        <div class="mb-3">
                            <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control"
                                value="{{ $factura->nombre_cliente }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellido_cliente" class="form-label">Apellido del Cliente</label>
                            <input type="text" name="apellido_cliente" id="apellido_cliente" class="form-control"
                                value="{{ $factura->apellido_cliente }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="n_identificacion_cliente" class="form-label">Identificación del Cliente</label>
                            <input type="text" name="n_identificacion_cliente" id="n_identificacion_cliente"
                                class="form-control" value="{{ $factura->n_identificacion_cliente }}" readonly>
                        </div>

                        <!-- Método de pago -->
                        <div class="mb-3">
                            <label for="metodo_pago" class="form-label">Método de Pago</label>
                            <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                                <option value="">Selecciona método de pago</option>
                                <option value="Efectivo" {{ $factura->metodo_pago == 'Efectivo' ? 'selected' : '' }}>
                                    Efectivo</option>
                                <option value="Tarjeta" {{ $factura->metodo_pago == 'Tarjeta' ? 'selected' : '' }}>
                                    Tarjeta</option>
                                <option value="Transferencia"
                                    {{ $factura->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia
                                </option>
                                <option value="Contraentrega"
                                    {{ $factura->metodo_pago == 'Contraentrega' ? 'selected' : '' }}>Contraentrega
                                </option>
                            </select>
                        </div>

                        <!-- Estado de la factura -->
                        <div class="mb-3">
                            <label for="estado_factura" class="form-label">Estado de la Factura</label>
                            <select name="estado_factura" id="estado_factura" class="form-select" required>
                                <option value="Activa" {{ $factura->estado_factura == 'Activa' ? 'selected' : '' }}>
                                    Activa</option>
                                <option value="Anulada" {{ $factura->estado_factura == 'Anulada' ? 'selected' : '' }}>
                                    Anulada</option>
                                <option value="Digital" {{ $factura->estado_factura == 'Digital' ? 'selected' : '' }}>
                                    Digital</option>
                                <option value="Impresa" {{ $factura->estado_factura == 'Impresa' ? 'selected' : '' }}>
                                    Impresa</option>
                            </select>
                        </div>

                        <!-- Total -->
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" name="total" id="total" class="form-control" step="0.01"
                                value="{{ $factura->total }}" required>
                        </div>

                        <!-- Notas -->
                        <div class="mb-3">
                            <label for="notas" class="form-label">Notas (opcional)</label>
                            <textarea name="notas" id="notas" class="form-control">{{ $factura->notas }}</textarea>
                        </div>

                        <!-- Botón de guardar -->
                        <button type="submit" class="btn btn-primary w-100">Actualizar Factura</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection