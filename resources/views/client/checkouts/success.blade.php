@extends('client.layouts.app')

@section('title', 'Pago Completado')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Gracias por tu compra']
])

@section('content')
<div class="container-fluid text-center py-5">
    <h2 class="mb-4">¡Tu pago fue completado!</h2>
    <p>Tu pedido está siendo procesado. Pronto recibirás detalles por correo.</p>

    @if(isset($venta))
    <div class="mt-4">
        <a href="{{ route('client.facturas.show', $venta->id_venta) }}" class="btn btn-primary">Ver Factura</a>
    </div>
    @else
    <div class="mt-4">
        <a href="{{ route('client.pedidos.index') }}" class="btn btn-secondary">Mis Pedidos</a>
    </div>
    @endif
</div>
@endsection