<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach (\App\Models\admin\Order::latest()->take(5)->get() as $pedido)
        <tr>
            <td>{{ $pedido->id_pedido }}</td>
            <td>{{ optional($pedido->client)->nombres ?? 'Desconocido' }}</td>
            <td>${{ number_format($pedido->total_pedido, 2) }}</td>
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
            <td>{{ $pedido->fecha_pedido }}</td>
            <td>
                <a href="{{ route('admin.pedidos.show', $pedido->id_pedido) }}"
                    class="btn btn-sm btn-outline-light">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>