@if ($pedidosRecientes->isNotEmpty())
<table class="table table-hover mb-0">
    <thead class="table-light">
        <tr>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pedidosRecientes as $pedido)
        <tr>
            <td>#{{ $pedido->id_venta }}</td>
            <td>{{ optional($pedido->client)->nombres ?? 'Desconocido' }}</td>
            <td>${{ number_format($pedido->total_venta, 2) }}</td>
            <td>
                <span class="badge bg-{{ $pedido->estado_venta === 'Pendiente' ? 'warning' : 'success' }}">
                    {{ $pedido->estado_venta }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.pedidos.show', $pedido->id_venta) }}"
                    class="btn btn-sm btn-outline-primary">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-muted text-center my-4">No hay pedidos recientes.</p>
@endif