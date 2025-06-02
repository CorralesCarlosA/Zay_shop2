@if(isset($pedidosRecientes) && $pedidosRecientes->isNotEmpty())
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 pt-3 pb-2">
        <h5 class="card-title mb-0 text-primary">
            <i class="fas fa-history me-2"></i>Pedidos Recientes
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID Pedido</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidosRecientes as $pedido)
                    <tr class="align-middle">
                        <td class="ps-4 fw-semibold text-muted">#{{ $pedido->id_pedido }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    {{ $pedido->cliente->nombres ?? 'N/A' }} 
                                    {{ $pedido->cliente->apellidos ?? '' }}
                                </div>
                            </div>
                        </td>
                        <td class="fw-bold text-success">${{ number_format($pedido->total_pedido, 2) }}</td>
                        <td>
                            <span class="badge bg-light text-dark">
                                {{-- Aquí deberías formatear la fecha adecuadamente --}}
                                {{ $pedido->fecha_pedido ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            @php
                                $estadoClass = [
                                    'pendiente' => 'bg-warning',
                                    'completado' => 'bg-success',
                                    'cancelado' => 'bg-danger'
                                ][$pedido->estado ?? 'pendiente'] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $estadoClass }} text-white text-uppercase">
                                {{ $pedido->estado ?? 'pendiente' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i> Ver
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 pt-2 pb-3">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Mostrando {{ count($pedidosRecientes) }} pedidos</small>
            <a href="#" class="btn btn-sm btn-link text-primary">Ver todos los pedidos</a>
        </div>
    </div>
</div>
@else
<div class="card shadow-sm border-0">
    <div class="card-body text-center py-5">
        <div class="mb-3">
            <i class="fas fa-clipboard-list fa-3x text-muted"></i>
        </div>
        <h5 class="text-muted mb-3">No hay pedidos recientes</h5>
        <p class="text-muted mb-4">No se encontraron pedidos recientes para mostrar.</p>
        <a href="#" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i> Crear nuevo pedido
        </a>
    </div>
</div>
@endif