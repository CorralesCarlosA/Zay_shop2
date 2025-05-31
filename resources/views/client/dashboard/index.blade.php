@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panel de Control')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    @include('admin.partials.stats-cards')
    
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
            @include('admin.partials.recent-customers')
        </div>
    </div>
</div>

<!-- Importar Chart.js desde CDN -->
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="{{ asset('js/admin/dashboard-charts.js') }}"></script>
@endpush
@endsection