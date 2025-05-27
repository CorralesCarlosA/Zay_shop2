@extends('admin.layouts.app')

@section('title', 'Panel de Administración')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')]
])

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- Tarjetas de resumen -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Productos</h6>
                    <h2 class="card-title mt-2">{{ $totalProductos ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Ventas Totales</h6>
                    <h2 class="card-title mt-2">${{ number_format($totalVentas ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-info text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Ventas Hoy</h6>
                    <h2 class="card-title mt-2">${{ number_format($ventasHoy ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Pedidos Pendientes</h6>
                    <h2 class="card-title mt-2">{{ $pedidosPendientes ?? 0 }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Gráfica de ventas -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Ventas Mensuales</h5>
                </div>
                <div class="card-body p-0">
                    <canvas id="ventasChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Últimos pedidos -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Últimos Pedidos</h5>
                    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                </div>
                <div class="card-body p-0">
                    @include('admin.partials.last_orders_table')
                </div>
            </div>
        </div>
    </div>

    <!-- Productos sin stock -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Productos sin Stock</h5>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-sm btn-outline-danger">Ir a
                        Inventario</a>
                </div>
                <div class="card-body p-0">
                    @if ($productosSinStock->isNotEmpty())
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productosSinStock as $producto)
                            <tr>
                                <td>{{ $producto->idProducto }}</td>
                                <td>{{ Str::limit($producto->nombreProducto, 30) }}</td>
                                <td>{{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}</td>
                                <td><span class="badge bg-danger">Stock:
                                        {{ optional($producto->inventario)->stock_actual ?? 0 }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted text-center my-4">No hay productos sin stock.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Clientes recientes -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Clientes Recientes</h5>
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-sm btn-outline-secondary">Ver Todos</a>
                </div>
                <div class="card-body p-0">
                    @if ($clientesRecientes->isNotEmpty())
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientesRecientes as $cliente)
                            <tr>
                                <td>{{ $cliente->n_identificacion }}</td>
                                <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                <td>{{ $cliente->correoE }}</td>
                                <td>{{ \Carbon\Carbon::parse($cliente->fecha_registro)->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted text-center my-4">No hay clientes nuevos hoy.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js "></script>
<script>
const ctx = document.getElementById('ventasChart').getContext('2d');
const ventasData = [{
    {
        $ventasMensuales - > implode(',') ?? '0,0,0,0,0,0'
    }
}];

const labels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Ventas del Mes',
            data: ventasData,
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => '$' + value.toLocaleString()
                }
            }
        }
    }
});
</script>
@endpush