@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h5>Detalles del Pedido #{{ $pedido->id_pedido }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6>Información del Cliente</h6>
                    <p><strong>Nombre:</strong> {{ $pedido->client->nombres ?? 'N/A' }}</p>
                    <p><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>
                    <p><strong>Ciudad:</strong> {{ $pedido->shippingCity->nombre_ciudad ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Información del Pedido</h6>
                    <p><strong>Fecha:</strong> {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</p>
                    <p><strong>Estado:</strong> <span class="badge bg-{{ $pedido->estadoColor() }}">{{ $pedido->estado_pedido }}</span></p>
                    <p><strong>Total:</strong> ${{ number_format($pedido->total_pedido, 2) }}</p>
                </div>
            </div>

            <h5>Productos</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedido->items as $item)
                    <tr>
                        <td>{{ $item->product->nombre ?? 'Producto eliminado' }}</td>
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