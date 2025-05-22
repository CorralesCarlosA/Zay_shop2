@extends('admin.layouts.app')

@section('title', 'Factura #' . $venta->id_venta)
@section('breadcrumbs', [
['name' => 'Reportes', 'url' => route('admin.reportes.ventas.index')],
['name' => 'Factura #' . $venta->id_venta]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5>Factura #{{ $venta->id_venta }}</h5>
            <a href="{{ route('admin.facturas.print', $venta->id_venta) }}" class="btn btn-outline-secondary btn-sm"
                target="_blank">Imprimir</a>
        </div>
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Datos del Cliente</h5>
                    <p><strong>Nombre:</strong> {{ optional($venta->client)->nombres ?? 'Anónimo' }}</p>
                    <p><strong>Correo:</strong> {{ optional($venta->client)->correoE ?? 'Desconocido' }}</p>
                    <p><strong>Dirección:</strong>
                        {{ optional($venta->client)->Direccion_recidencia ?? 'No disponible' }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Datos de la Factura</h5>
                    <p><strong>ID:</strong> {{ $factura->id_factura }}</p>
                    <p><strong>Fecha:</strong> {{ now() }}</p>
                    <p><strong>Total:</strong> ${{ number_format($venta->total_venta, 2) }}</p>
                </div>
            </div>

            <hr>

            <h5>Productos Vendidos</h5>
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->items as $item)
                    <tr>
                        <td>{{ $item->id_detalle_venta }}</td>
                        <td>{{ optional($item->product)->nombreProducto ?? 'Producto eliminado' }}</td>
                        <td>{{ $item->cantidad_pedido }}</td>
                        <td>${{ number_format($item->precio_unitario, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-end mt-4">
                <h5><strong>Total:</strong> ${{ number_format($venta->total_venta, 2) }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection