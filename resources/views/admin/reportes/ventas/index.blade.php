@extends('admin.layouts.app')

@section('title', 'Reporte de Ventas')
@section('breadcrumbs')
@php
$breadcrumbs = [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Reportes'],
['name' => 'Ventas']
];
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        @foreach ($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item">
            @if (isset($breadcrumb['url']))
            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
            @else
            {{ $breadcrumb['name'] }}
            @endif
        </li>
        @endforeach
    </ol>
</nav>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Tarjetas resumen -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <h6>Ventas del Mes</h6>
                    <h2>${{ number_format($ventasMesActual ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <h6>Ventas del Mes Anterior</h6>
                    <h2>${{ number_format($ventasMesAnterior ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-info text-white">
                <div class="card-body">
                    <h6>Promedio Mensual</h6>
                    <h2>${{ number_format($promedioMensual ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-white">
                <div class="card-body">
                    <h6>Promedio Diario</h6>
                    <h2>${{ number_format($promedioDiario ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>

        <!-- Gráficas -->
        <div class="col-md-6 mt-4">
            <canvas id="ventasPorDiaChart"></canvas>
        </div>

        <div class="col-md-6 mt-4">
            <canvas id="comparacionMensualChart"></canvas>
        </div>

        <div class="col-md-12 mt-4">
            <canvas id="ventasAnualesChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js "></script>
<script>
const ventasPorDia = @json($ventasPorDia ?? []);
const ventasAnuales = @json($ventasAnuales ?? []);
const ventasMesActual = parseFloat("{{ $ventasMesActual ?? 0 }}");
const ventasMesAnterior = parseFloat("{{ $ventasMesAnterior ?? 0 }}");
const promedioMensual = parseFloat("{{ $promedioMensual ?? 0 }}");
const promedioDiario = parseFloat("{{ $promedioDiario ?? 0 }}");

// Gráfica: Ventas Diarias
const ctxVentaDia = document.getElementById('ventasPorDiaChart').getContext('2d');
new Chart(ctxVentaDia, {
    type: 'line',
    data: {
        labels: ventasPorDia.map(v => v.dia),
        datasets: [{
            label: 'Total Vendido ($)',
            data: ventasPorDia.map(v => v.total),
            borderColor: '#198754',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            fill: true,
            tension: 0.3,
            pointRadius: 3,
            pointBackgroundColor: '#198754'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            },
            tooltip: {
                callbacks: {
                    label: context => `$${parseFloat(context.parsed.y).toFixed(2)}`
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: value => `$${value}`
                }
            }
        }
    }
});

// Gráfica: Comparación Mensual
const ctxComparacionMensual = document.getElementById('comparacionMensualChart').getContext('2d');
new Chart(ctxComparacionMensual, {
    type: 'bar',
    data: {
        labels: ['Mes Actual', 'Mes Anterior'],
        datasets: [{
            label: 'Ventas Totales',
            data: [ventasMesActual, ventasMesAnterior],
            backgroundColor: ['#198754', '#ffc107']
        }]
    },
    options: {
        indexAxis: 'x',
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => `$${value.toFixed(2)}`
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: context => `$${context.raw.toFixed(2)}`
                }
            }
        }
    }
});

// Gráfica: Ventas Anuales
const ctxAnuales = document.getElementById('ventasAnualesChart').getContext('2d');
new Chart(ctxAnuales, {
    type: 'bar',
    data: {
        labels: Object.keys(ventasAnuales),
        datasets: [{
            label: 'Ventas por Mes',
            data: Object.values(ventasAnuales),
            backgroundColor: '#4D4DFF'
        }]
    },
    options: {
        indexAxis: 'x',
        scales: {
            y: {
                ticks: {
                    callback: value => `$${value.toFixed(2)}`
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: context => `$${context.raw.toFixed(2)}`
                }
            }
        }
    }
});
</script>
@endpush