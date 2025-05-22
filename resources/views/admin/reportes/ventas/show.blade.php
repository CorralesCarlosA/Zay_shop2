@extends('admin.layouts.app')

@section('title', 'Venta #' . $venta->id_venta)
@section('breadcrumbs', [
['name' => 'Reportes', 'url' => route('admin.reportes.ventas.index')],
['name' => 'Detalle #' . $venta->id_venta]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5>Detalles de la Venta #{{ $venta->id_venta }}</h5>
            <a href="{{ route('admin.reportes.ventas.invoice.generate', $venta->id_venta) }}"
                class="btn btn-success btn-sm" target="_blank">Generar Factura</a>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> {{ optional($venta->client)->nombres ?? 'Anónimo' }}</p>
                    <p><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
                    <p><strong>Método de Pago:</strong> {{ $venta->metodo_pago }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Total:</strong> ${{ number_format($venta->total_venta, 2) }}</p>
                    <p><strong>Estado:</strong> {{ $venta->estado_venta }}</p>
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
                        <td>{{ optional($item->product)->nombreProducto ?? 'Producto no encontrado' }}</td>
                        <td>{{ $item->cantidad_pedido }}</td>
                        <td>${{ number_format($item->precio_unitario, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection