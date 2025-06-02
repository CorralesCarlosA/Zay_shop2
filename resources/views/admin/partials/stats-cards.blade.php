<style>
    /* Estilos para las tarjetas de estadísticas */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        border-radius: 12px;
        color: white;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        min-height: 180px;
        display: flex;
        flex-direction: column;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scale(1.1);
    }
    
    .stat-card .card-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    .stat-card .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        margin-top: 0.5rem;
    }
    
    .stat-card .card-link {
        color: white;
        text-decoration: none;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        margin-top: auto;
        opacity: 0.9;
    }
    
    .stat-card .card-link:hover {
        opacity: 1;
        transform: translateX(3px);
    }
    
    .stat-card .card-link i {
        margin-left: 0.5rem;
        font-size: 0.8rem;
        transition: all 0.2s ease;
    }
    
    .stat-card .card-link:hover i {
        transform: translateX(3px);
    }
    
    /* Colores específicos para cada tarjeta */
    .stat-card.products {
        background: linear-gradient(135deg, #2c4926, #3d6b35);
    }
    
    .stat-card.sales {
        background: linear-gradient(135deg, #b78732, #d4a346);
    }
    
    .stat-card.today-sales {
        background: linear-gradient(135deg, #b79f5e, #d4c07e);
    }
    
    .stat-card.pending {
        background: linear-gradient(135deg, #444242, #6b6969);
    }
</style>

<div class="stats-grid">
    <!-- Productos Activos -->
    <div class="stat-card products">
        <h6 class="card-subtitle">Productos Activos</h6>
        <h3 class="card-title">{{ $totalProductos ?? 0 }}</h3>
        <a href="{{ route('admin.productos.index') }}" class="card-link">
            Ver todos <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
    <!-- Ventas Totales -->
    <div class="stat-card sales">
        <h6 class="card-subtitle">Ventas Totales</h6>
        <h3 class="card-title">${{ number_format($totalVentas ?? 0, 2) }}</h3>
        <a href="{{ route('admin.ventas.index') }}" class="card-link">
            Ver reporte <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
    <!-- Ventas Hoy -->
    <div class="stat-card today-sales">
        <h6 class="card-subtitle">Ventas Hoy</h6>
        <h3 class="card-title">${{ number_format($ventasHoy ?? 0, 2) }}</h3>
        <a href="{{ route('admin.ventas.index') }}?fecha={{ today()->format('Y-m-d') }}" class="card-link">
            Ver hoy <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
    <!-- Pedidos Pendientes -->
    <div class="stat-card pending">
        <h6 class="card-subtitle">Pedidos Pendientes</h6>
        <h3 class="card-title">{{ $pedidosPendientes ?? 0 }}</h3>
        <a href="{{ route('admin.pedidos.index') }}?estado=En+proceso" class="card-link">
            Gestionar <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>