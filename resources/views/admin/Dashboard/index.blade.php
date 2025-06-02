@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panel de Control')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="stats-grid">
        @include('admin.partials.stats-cards')
    </div>
    
    <!-- Datos para gráficos -->
    <div id="chart-data" 
         data-meses='@json($mesesLabels)'
         data-ventas='@json($ventasChartData)'
         style="display:none;"></div>
    
    <!-- Contenido principal -->
    <div class="main-content-grid">
        <!-- Gráfico principal -->
        <div class="animate-card">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line"></i> Ventas Mensuales
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pedidos recientes -->
        <div class="animate-card">
            @include('admin.partials.recent-orders')
        </div>
    </div>
    
    <!-- Contenido secundario -->
    <div class="secondary-content-grid">
        <!-- Productos agotados -->
        <div class="animate-card">
            @include('admin.partials.out-of-stock')
        </div>
        
        <!-- Clientes recientes -->
        <div class="animate-card">
            @include('admin.partials.recent-customers', [
                'recentCustomers' => $recentCustomers ?? collect()
            ])
        </div>
    </div>
</div>

<!-- Scripts (deberían estar en archivos externos) -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar animaciones
        document.querySelectorAll('.animate-card').forEach((el, index) => {
            el.style.animationDelay = `${0.1 * (index + 1)}s`;
        });

        // Gráfico de ventas
        const chartData = document.getElementById('chart-data');
        if (chartData) {
            const ctx = document.getElementById('salesChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(chartData.dataset.meses),
                        datasets: [{
                            label: 'Ventas',
                            data: JSON.parse(chartData.dataset.ventas),
                            backgroundColor: 'rgba(44, 73, 38, 0.1)',
                            borderColor: 'rgba(44, 73, 38, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            pointBackgroundColor: '#ffc649',
                            pointBorderColor: '#ffffff',
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' $' + context.raw.toLocaleString();
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        }
    });
</script>
@endpush
@endsection