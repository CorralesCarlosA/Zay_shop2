<!-- Archivo: resources/views/admin/partials/recent-orders.blade.php -->
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Pedidos Recientes</h5>
    </div>
    <div class="card-body">
        @if(count($recentOrders) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $pedido)
                            <tr>
                                <td>#{{ $pedido->id_pedido }}</td>
                                <td>{{ $pedido->nombre_cliente }} {{ $pedido->apellido_cliente }}</td>
                                <td>${{ number_format($pedido->total_pedido, 2) }}</td>
                                <td>{{ date('d/m/Y', strtotime($pedido->fecha_pedido)) }}</td>
                                <td>{{ $pedido->estado_pedido }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('admin.pedidos.index') }}" class="btn btn-sm btn-outline-primary">
                    Ver todos los pedidos
                </a>
            </div>
        @else
            <div class="alert alert-info mb-0">
                No hay pedidos recientes
            </div>
        @endif
    </div>
</div>