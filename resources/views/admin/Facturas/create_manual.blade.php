@extends('admin.layouts.app')

@section('title', 'Crear Factura Manualmente')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Facturas', 'url' => route('admin.facturas.index')],
['name' => 'Crear Manualmente']
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.facturas.manual.store') }}">
                        @csrf

                        <!-- Seleccionar venta -->
                        <div class="mb-3">
                            <label for="id_venta" class="form-label">Venta Asociada</label>
                            <select name="id_venta" id="id_venta" class="form-select" required>
                                <option value="">Selecciona una venta</option>
                                @foreach ($ventas as $venta)
                                <option value="{{ $venta->id_venta }}">Venta #{{ $venta->id_venta }} -
                                    ${{ number_format($venta->total_venta, 2) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100 mt-4">Generar Factura</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection