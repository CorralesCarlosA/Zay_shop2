@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panel de Control')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    @include('admin.partials.stats-cards')
    
    <!-- Pasar datos a JavaScript -->
    <div id="chart-data" 
         data-meses='@json($mesesLabels)'
         data-ventas='@json($ventasChartData)'
         style="display:none;"></div>
    
    <!-- Gráficos principales -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Ventas Mensuales</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @include('admin.partials.recent-orders')
        </div>
    </div>
    
    <!-- Secciones adicionales -->
    <div class="row mt-4">
        <div class="col-md-6">
            @include('admin.partials.out-of-stock')
        </div>
        <div class="col-md-6">
@include('admin.partials.recent-customers', [
    'recentCustomers' => $recentCustomers ?? collect()
])
        </div>
    </div>
</div>

<!-- Importar dependencias y script externo -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin/sales-chart.js') }}"></script>
@endpush
@endsection