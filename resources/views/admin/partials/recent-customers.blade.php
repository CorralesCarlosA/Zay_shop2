<style>
    /* Estilos para la tarjeta de clientes recientes */
    .recent-customers-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        background-color: white;
    }
    
    .recent-customers-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    .recent-customers-card .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .recent-customers-card .card-header h5 {
        margin: 0;
        font-weight: 600;
        color: #2c4926;
        font-size: 1.1rem;
    }
    
    .recent-customers-card .card-header h5 i {
        color: #b78732;
        margin-right: 0.75rem;
    }
    
    .recent-customers-card .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .recent-customers-card .table thead th {
        background-color: #f8f9fa;
        color: #444242;
        font-weight: 600;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 0.75rem 1.5rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .recent-customers-card .table tbody td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0,0,0,0.03);
        transition: all 0.2s ease;
    }
    
    .recent-customers-card .table tbody tr:hover td {
        background-color: rgba(183, 135, 50, 0.03);
    }
    
    .recent-customers-card .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .recent-customers-card .customer-type {
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 50px;
        min-width: 70px;
        text-align: center;
        display: inline-block;
    }
    
    .recent-customers-card .customer-type.oro {
        background-color: #EFD9AB;
        color: #b78732;
        border: 1px solid #b79f5e;
    }
    
    .recent-customers-card .customer-type.plata {
        background-color: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
    }
    
    .recent-customers-card .customer-type.bronce {
        background-color: #f5e8e8;
        color: #dc3545;
        border: 1px solid #f1d1d1;
    }
    
    .recent-customers-card .customer-type.hierro {
        background-color: #e9ecef;
        color: #444242;
        border: 1px solid #d9d9d9;
    }
    
    .recent-customers-card .view-all-btn {
        background-color: transparent;
        border: 1px solid #2c4926;
        color: #2c4926;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
    }
    
    .recent-customers-card .view-all-btn:hover {
        background-color: #2c4926;
        color: white;
        transform: translateY(-2px);
    }
    
    .recent-customers-card .view-all-btn i {
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .recent-customers-card .view-all-btn:hover i {
        transform: translateX(3px);
    }
    
    .recent-customers-card .no-customers-alert {
        background-color: rgba(239, 217, 171, 0.3);
        border: none;
        color: #444242;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
    }
    
    .recent-customers-card .no-customers-alert i {
        color: #b78732;
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }
</style>

<div class="recent-customers-card">
    <div class="card-header">
        <h5><i class="fas fa-users"></i> Clientes Recientes</h5>
    </div>
    <div class="card-body p-0">
        @if($recentCustomers->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Registro</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentCustomers as $cliente)
                            <tr>
                                <td>{{ $cliente->n_identificacion }}</td>
                                <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                <td>{{ $cliente->n_telefono }}</td>
                                <td>{{ date('d/m/Y', strtotime($cliente->fecha_registro)) }}</td>
                                <td>
                                    <span class="customer-type {{ strtolower($cliente->tipo_cliente) }}">
                                        {{ $cliente->tipo_cliente }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center p-3">
                <a href="{{ route('admin.clientes.index') }}" class="view-all-btn">
                    Ver todos los clientes <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="no-customers-alert">
                <i class="fas fa-info-circle"></i>
                <p class="mb-0">No hay clientes recientes</p>
            </div>
        @endif
    </div>
</div>