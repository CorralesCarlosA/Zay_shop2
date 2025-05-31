@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h5>Listado de Pedidos</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id_pedido }}</td>
                        <td>{{ $pedido->client->nombres ?? 'N/A' }}</td>
                        <td>{{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</td>
                        <td>${{ number_format($pedido->total_pedido, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $pedido->estadoColor() }}">
                                {{ $pedido->estado_pedido }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.pedidos.show', $pedido->id_pedido) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('admin.pedidos.edit', $pedido->id_pedido) }}" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pedidos->links() }}
        </div>
    </div>
</div>
@endsection