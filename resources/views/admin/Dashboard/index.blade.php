@extends('admin.layouts.app')

@section('title', 'Dashboard - ZayShop Admin')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text display-4 fw-bold">{{ \App\Models\client\Client::count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text display-4 fw-bold">{{ \App\Models\admin\Product::count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <p class="card-text display-4 fw-bold">
                        {{ \App\Models\admin\Order::where('estado_pedido', 'Pendiente')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Mensajes sin responder</h5>
                    <p class="card-text display-4 fw-bold">
                        {{ \App\Models\admin\Message::where('estado_mensaje', 'Abierto')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h4>Acciones recientes</h4>
        <ul class="list-group">
            @foreach (\App\Models\admin\HistorySaleStatus::latest()->take(5)->get() as $accion)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $accion->accion }}</span>
                <small class="text-muted">{{ $accion->fecha_accion }}</small>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection