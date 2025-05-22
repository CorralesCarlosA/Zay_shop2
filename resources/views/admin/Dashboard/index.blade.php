@extends('admin.layouts.app')

@section('title', 'Panel de Administración')
@section('breadcrumbs', [])

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- Tarjetas de resumen -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Productos</h6>
                    <h2 class="card-title mt-2">{{ $totalProductos }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Ventas Totales</h6>
                    <h2 class="card-title mt-2">${{ number_format($totalVentas, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-info text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Ventas Hoy</h6>
                    <h2 class="card-title mt-2">${{ number_format($ventasHoy, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-white">
                <div class="card-body">
                    <h6 class="card-subtitle">Pedidos Pendientes</h6>
                    <h2 class="card-title mt-2">{{ $pedidosPendientes }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4>Últimos Pedidos</h4>
        @include('admin.partial.last_orders_table')
    </div>
</div>
@endsection