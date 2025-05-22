@extends('admin.layouts.app')

@section('title', 'Facturas')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Facturas']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Facturas</h2>
        <a href="{{ route('admin.facturas.create.manual') }}" class="btn btn-success">Generar Manualmente</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                    <th>Fecha Emisión</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                <tr>
                    <td>{{ $factura->id_factura }}</td>
                    <td>{{ optional($factura->client)->nombres ?? 'Anónimo' }}</td>
                    <td>${{ number_format($factura->total_venta, 2) }}</td>
                    <td>{{ $factura->metodo_pago }}</td>
                    <td>{{ $factura->fecha_emision }}</td>
                    <td>
                        <a href="{{ route('admin.facturas.show', $factura->id_factura) }}"
                            class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('admin.facturas.print', $factura->id_factura) }}"
                            class="btn btn-sm btn-outline-dark" target="_blank">Imprimir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection