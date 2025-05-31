@extends('admin.layouts.app')

@section('title', 'Pedidos - Panel Admin')

@section('title', 'Pedidos - Panel Admin')

<div class="container-fluid">
    @if(session('download_url'))
        <div class="alert alert-success">
            <a href="{{ session('download_url') }}" class="btn btn-primary">Descargar Factura</a>
        </div>
    @endif
    
    <div class="card shadow">
        <!-- ... resto del código ... -->
    </div>
</div>


@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Pedidos</h2>
        <a href="{{ route('admin.pedidos.create') }}" class="btn btn-success">Nuevo Pedido</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.pedidos.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="cliente" class="form-control" placeholder="Buscar por cliente o identificación"
                    value="{{ request('cliente') }}">
            </div>
            <div class="col-md-4">
                <select name="estado_pedido" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="En proceso" {{ request('estado_pedido') == 'En proceso' ? 'selected' : '' }}>En
                        proceso</option>
                    <option value="Listo para recogida"
                        {{ request('estado_pedido') == 'Listo para recogida' ? 'selected' : '' }}>Listo para recogida
                    </option>
                    <option value="Enviado" {{ request('estado_pedido') == 'Enviado' ? 'selected' : '' }}>Enviado
                    </option>
                    <option value="Entregado" {{ request('estado_pedido') == 'Entregado' ? 'selected' : '' }}>Entregado
                    </option>
                    <option value="Cancelado" {{ request('estado_pedido') == 'Cancelado' ? 'selected' : '' }}>Cancelado
                    </option>
                </select>
            </div>

            <!-- Aquí insertas el select de método de pago -->
            <div class="col-md-4">
                <select name="metodo_pago" class="form-select">
                    <option value="">Todos los métodos</option>
                    <option value="Efectivo" {{ request('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo
                    </option>
                    <option value="Tarjeta" {{ request('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    <option value="Transferencia" {{ request('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>
                        Transferencia</option>
                    <option value="Contraentrega" {{ request('metodo_pago') == 'Contraentrega' ? 'selected' : '' }}>
                        Contraentrega</option>
                    <option value="Mercado Pago" {{ request('metodo_pago') == 'Mercado Pago' ? 'selected' : '' }}>
                        Mercado Pago</option>
                    <option value="PayPal" {{ request('metodo_pago') == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                    <option value="PayU" {{ request('metodo_pago') == 'PayU' ? 'selected' : '' }}>PayU</option>
                </select>
            </div>

            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de pedidos -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Total</th>
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
        @if($pedido->factura_generada)
            <span class="badge bg-success">Facturado</span>
        @else
            <span class="badge bg-warning">Pendiente</span>
        @endif
    </td>
    <td>
        <a href="{{ route('admin.pedidos.show', $pedido->id_pedido) }}" class="btn btn-sm btn-info">Ver</a>
        <a href="{{ route('admin.pedidos.edit', $pedido->id_pedido) }}" class="btn btn-sm btn-primary">Editar</a>
    </td>
</tr>
@endforeach

        </tbody>
    </table>
</div>
@endsection