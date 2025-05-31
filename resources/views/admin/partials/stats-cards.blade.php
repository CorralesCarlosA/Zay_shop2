<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Productos Activos</h6>
                <h3 class="card-title">{{ $totalProductos ?? 0 }}</h3>
                <a href="{{ route('admin.productos.index') }}" class="text-white small">Ver todos</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Ventas Totales</h6>
                <h3 class="card-title">${{ number_format($totalVentas ?? 0, 2) }}</h3>
                <a href="{{ route('admin.ventas.index') }}" class="text-white small">Ver reporte</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Ventas Hoy</h6>
                <h3 class="card-title">${{ number_format($ventasHoy ?? 0, 2) }}</h3>
                <a href="{{ route('admin.ventas.index') }}?fecha={{ today()->format('Y-m-d') }}" class="text-white small">Ver hoy</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Pedidos Pendientes</h6>
                <h3 class="card-title">{{ $pedidosPendientes ?? 0 }}</h3>
                <a href="{{ route('admin.pedidos.index') }}?estado=En+proceso" class="text-white small">Gestionar</a>
            </div>
        </div>
    </div>
</div>