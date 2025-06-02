<style>
    /* Estilos premium para pedidos recientes */
    .recent-orders-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(44, 73, 38, 0.08);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        background: white;
        position: relative;
    }

    .recent-orders-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, #b78732, #2c4926);
    }

    .recent-orders-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(44, 73, 38, 0.15);
    }

    .recent-orders-card .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(239, 217, 171, 0.5);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
    }

    .recent-orders-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        color: #2c4926;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
    }

    .recent-orders-card .card-header h5 i {
        color: #b78732;
        margin-right: 12px;
        font-size: 1.2rem;
    }

    .recent-orders-card .table-container {
        padding: 0 1.5rem;
    }

    .recent-orders-card .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .recent-orders-card .table thead th {
        background-color: #f9f9f9;
        color: #444242;
        font-weight: 600;
        border: none;
        padding: 12px 16px;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .recent-orders-card .table tbody tr {
        background: white;
        transition: all 0.3s ease;
        position: relative;
    }

    .recent-orders-card .table tbody tr::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(239, 217, 171, 0.5), transparent);
    }

    .recent-orders-card .table tbody tr:hover {
        box-shadow: 0 5px 15px rgba(183, 135, 50, 0.1);
        transform: translateY(-2px);
    }

    .recent-orders-card .table tbody td {
        padding: 16px;
        vertical-align: middle;
        border: none;
        position: relative;
        font-size: 0.9rem;
    }

    .recent-orders-card .table tbody td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .recent-orders-card .table tbody td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .recent-orders-card .order-status {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 50px;
        display: inline-block;
        min-width: 90px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .recent-orders-card .status-completed {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .recent-orders-card .status-processing {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .recent-orders-card .status-pending {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    .recent-orders-card .status-cancelled {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .recent-orders-card .view-all-btn {
        background: white;
        border: 1px solid #2c4926;
        color: #2c4926;
        font-weight: 500;
        padding: 8px 24px;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        margin: 1.5rem 0;
        box-shadow: 0 2px 10px rgba(44, 73, 38, 0.05);
    }

    .recent-orders-card .view-all-btn:hover {
        background: linear-gradient(to right, #2c4926, #3d6b35);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(44, 73, 38, 0.15);
        border-color: transparent;
    }

    .recent-orders-card .view-all-btn i {
        margin-left: 8px;
        transition: all 0.3s ease;
    }

    .recent-orders-card .view-all-btn:hover i {
        transform: translateX(4px);
    }

    .recent-orders-card .no-orders {
        padding: 2rem;
        text-align: center;
        color: #6c757d;
    }

    .recent-orders-card .no-orders i {
        font-size: 2rem;
        color: #b78732;
        margin-bottom: 1rem;
        opacity: 0.7;
    }

    .recent-orders-card .no-orders p {
        margin: 0;
        font-size: 0.95rem;
    }
</style>

<div class="recent-orders-card">
    <div class="card-header">
        <h5><i class="fas fa-clipboard-list"></i> Pedidos Recientes</h5>
    </div>
    
    <div class="card-body">
        @if(count($recentOrders) > 0)
            <div class="table-responsive table-container">
                <table class="table">
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
                                <td>
                                    @php
                                        $statusClass = '';
                                        if(str_contains($pedido->estado_pedido, 'Complet')) $statusClass = 'status-completed';
                                        elseif(str_contains($pedido->estado_pedido, 'Proces')) $statusClass = 'status-processing';
                                        elseif(str_contains($pedido->estado_pedido, 'Pendiente')) $statusClass = 'status-pending';
                                        elseif(str_contains($pedido->estado_pedido, 'Cancel')) $statusClass = 'status-cancelled';
                                    @endphp
                                    <span class="order-status {{ $statusClass }}">
                                        {{ $pedido->estado_pedido }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <a href="{{ route('admin.pedidos.index') }}" class="view-all-btn">
                    Ver todos los pedidos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="no-orders">
                <i class="fas fa-clipboard"></i>
                <p>No hay pedidos recientes</p>
            </div>
        @endif
    </div>
</div>