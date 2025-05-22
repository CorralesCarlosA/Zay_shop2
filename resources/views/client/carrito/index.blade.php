@extends('client.layouts.app')

@section('title', 'Mi Carrito')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Carrito']
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Mi Carrito</h5>
        </div>
        <div class="card-body">

            @if ($carrito->isEmpty())
            <div class="alert alert-info">Tu carrito está vacío.</div>
            @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito as $item)
                    <tr>
                        <td>{{ $item->product->nombreProducto }}</td>
                        <td>{{ $item->cantidad_pedido }}</td>
                        <td>${{ number_format($item->product->precioProducto, 2) }}</td>
                        <td>${{ number_format($item->product->precioProducto * $item->cantidad_pedido, 2) }}</td>
                        <td>
                            <form action="{{ route('client.carrito.remove', $item->id_carrito) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este producto del carrito?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                <h5><strong>Total:</strong> ${{ number_format($total, 2) }}</h5>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('client.checkout.index') }}" class="btn btn-primary">Proceder a Pagar</a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <h5>Métodos de Pago</h5>

        <form action="{{ route('client.checkout.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="metodo_pago" value="Mercado Pago">
            <button type="submit" class="btn btn-danger w-100 mt-2">Pagar con Mercado Pago</button>
        </form>

        <form action="{{ route('client.checkout.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="metodo_pago" value="PayPal">
            <button type="submit" class="btn btn-info text-white w-100 mt-2">Pagar con PayPal</button>
        </form>

        <form action="{{ route('client.checkout.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="metodo_pago" value="PayU">
            <button type="submit" class="btn btn-success w-100 mt-2">Pagar con PayU</button>
        </form>

        <form action="{{ route('client.checkout.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="metodo_pago" value="Contraentrega">
            <button type="submit" class="btn btn-warning w-100 mt-2">Pagar contraentrega</button>
        </form>

        <form action="{{ route('client.checkout.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="metodo_pago" value="Transferencia">
            <button type="submit" class="btn btn-secondary w-100 mt-2">Pagar por transferencia</button>
        </form>
    </div>
</div>
@endsection