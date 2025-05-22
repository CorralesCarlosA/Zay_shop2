@extends('admin.layouts.app')

@section('title', 'Detalles del Pedido #' . $pedido->id_pedido)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Pedidos', 'url' => route('admin.pedidos.index')],
['name' => 'Pedido #' . $pedido->id_pedido]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5>Detalles del Pedido #{{ $pedido->id_pedido }}</h5>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Cliente:</strong><br>
                    {{ optional($pedido->client)->nombres }}<br>
                    {{ optional($pedido->client)->correoE }}
                </div>
                <div class="col-md-6 text-md-end">
                    <strong>Fecha:</strong> {{ $pedido->fecha_pedido }}<br>
                    <strong>Dirección:</strong> {{ $pedido->direccion_envio }},
                    {{ optional($pedido->city)->nombre_ciudad }}
                </div>
            </div>

            <h5>Productos</h5>
            <table class="table table-bordered table-striped mb-4">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Talla</th>
                        <th>Color</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->details as $detalle)
                    <tr>
                        <td>{{ optional($detalle->product)->nombreProducto }}</td>
                        <td>{{ optional($detalle->size)->nombre_talla ?? 'Única' }}</td>
                        <td>{{ optional($detalle->color)->nombreColor ?? 'Sin color' }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>{{ $detalle->cantidad_pedido }}</td>
                        <td>${{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end mb-4">
                <h5><strong>Total:</strong> ${{ number_format($pedido->total_pedido, 2) }}</h5>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.pedidos.edit', $pedido->id_pedido) }}" class="btn btn-warning">Cambiar
                    Estado</a>
                <form action="{{ route('admin.facturas.generate.pedido', $pedido->id_pedido) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Generar Factura</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection