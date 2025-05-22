@extends('admin.layouts.app')

@section('title', 'Crear Nuevo Cupón')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Cupones', 'url' => route('admin.cupones.index')],
['name' => 'Nuevo']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Nuevo Cupón de Descuento</h4>

                    <form method="POST" action="{{ route('admin.cupones.store') }}">
                        @csrf

                        <!-- Código del cupón -->
                        <div class="mb-3">
                            <label for="codigo_cupon" class="form-label">Código del Cupón</label>
                            <input type="text" name="codigo_cupon" id="codigo_cupon" class="form-control" required
                                autofocus>
                        </div>

                        <!-- Tipo de descuento -->
                        <div class="mb-3">
                            <label for="tipo_descuento" class="form-label">Tipo de Descuento</label>
                            <select name="tipo_descuento" id="tipo_descuento" class="form-select" required>
                                <option value="">Selecciona tipo</option>
                                <option value="Porcentaje">Porcentaje</option>
                                <option value="Valor fijo">Valor Fijo</option>
                            </select>
                        </div>

                        <!-- Valor comprado -->
                        <div class="mb-3">
                            <label for="valor_comprado" class="form-label">Valor Mínimo de Compra</label>
                            <input type="number" name="valor_comprado" id="valor_comprado" class="form-control" min="0"
                                step="0.01" required>
                        </div>

                        <!-- Valor del cupón -->
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor del Descuento</label>
                            <input type="number" name="valor" id="valor" class="form-control" min="0.01" step="0.01"
                                required>
                        </div>

                        <!-- Fecha de expiración -->
                        <div class="mb-3">
                            <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
                            <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control"
                                required>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="activo" id="activo" class="form-check-input" checked>
                            <label for="activo" class="form-check-label">¿Está activo?</label>
                        </div>

                        <!-- Cantidad mínima de productos -->
                        <div class="mb-3">
                            <label for="cantidad_prudcutos_minimos" class="form-label">Cantidad mínima de
                                productos</label>
                            <input type="number" name="cantidad_prudcutos_minimos" id="cantidad_prudcutos_minimos"
                                class="form-control" min="1" value="1">
                        </div>

                        <!-- Máximo de usos por cliente -->
                        <div class="mb-3">
                            <label for="max_usos_por_cliente" class="form-label">Máximos usos por cliente</label>
                            <input type="number" name="max_usos_por_cliente" id="max_usos_por_cliente"
                                class="form-control" min="1" value="1">
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Cupón</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection