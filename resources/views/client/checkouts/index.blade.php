@extends('client.layouts.app')

@section('title', 'Resumen del Pedido')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Carrito', 'url' => route('client.carrito.index')],
['name' => 'Pagar']
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Detalles del pedido -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5>Productos en tu carrito</h5>
                </div>
                <div class="card-body">

                    @foreach ($productos as $producto)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <strong>{{ $producto->nombreProducto }}</strong><br>
                            {{ $producto->cantidad }} x ${{ number_format($producto->precioProducto, 2) }}
                        </div>
                        <div>
                            ${{ number_format($producto->subtotal, 2) }}
                        </div>
                    </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5>Total:</h5>
                        <h5>${{ number_format($total, 2) }}</h5>
                    </div>

                </div>
            </div>
        </div>

        <!-- Métodos de pago -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5>Métodos de Pago</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tarjeta
                            <a href="{{ route('client.checkout.payment', ['method' => 'Tarjeta']) }}"
                                class="btn btn-success btn-sm">Pagar</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Transferencia Bancaria
                            <a href="{{ route('client.checkout.payment', ['method' => 'Transferencia']) }}"
                                class="btn btn-primary btn-sm">Seleccionar</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Contraentrega
                            <a href="{{ route('client.checkout.payment', ['method' => 'Contraentrega']) }}"
                                class="btn btn-warning btn-sm">Confirmar</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            PayU
                            <a href="{{ route('client.checkout.payment', ['method' => 'PayU']) }}"
                                class="btn btn-info text-white btn-sm">Ir a PayU</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Mercado Pago
                            <a href="{{ route('client.checkout.payment', ['method' => 'Mercado Pago']) }}"
                                class="btn btn-danger btn-sm">Ir a Mercado Pago</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            PayPal
                            <a href="{{ route('client.checkout.payment', ['method' => 'PayPal']) }}"
                                class="btn btn-secondary btn-sm">Ir a PayPal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection