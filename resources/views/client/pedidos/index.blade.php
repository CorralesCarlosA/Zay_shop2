@extends('client.layouts.app')

@section('title', 'Mis Pedidos')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Mis Pedidos']
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Mis Pedidos</h5>
        </div>
        <div class="card-body">

            @if ($pedidos->isEmpty())
            <div class="alert alert-info">No has realizado ningún pedido aún.</div>
            @else
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id_pedido }}</td>
                        <td>{{ $pedido->fecha_pedido }}</td>
                        <td>
                            <span class="badge bg-{{ match($pedido->estado_pedido) {
                                        'En proceso' => 'primary',
                                        'Listo para recogida' => 'warning',
                                        'Enviado' => 'info',
                                        'Entregado' => 'success',
                                        default => 'danger'
                                    } }}">
                                {{ $pedido->estado_pedido }}
                            </span>
                        </td>
                        <td>${{ number_format($pedido->total_pedido, 2) }}</td>
                        <td>
                            <a href="{{ route('client.pedidos.show', $pedido->id_pedido) }}"
                                class="btn btn-sm btn-primary">Ver Detalle</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection