@extends('admin.layouts.app')

@section('title', 'Reporte de Inventario')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Reportes'],
['name' => 'Inventario']
])

@section('content')
<div class="container-fluid">
    <div class="row g-4">

        <!-- Stock bajo -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5>Stock Bajo</h5>
                </div>
                <div class="card-body">
                    @if ($stockBajo->isEmpty())
                    <p class="text-muted">No hay productos con stock bajo.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($stockBajo as $producto)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $producto->nombreProducto }}
                            <span class="badge bg-danger rounded-pill">{{ $producto->inventory->stock_actual }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Más vendidos -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5>Productos Más Vendidos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Total Vendido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masVendidos as $item)
                            <tr>
                                <td>{{ optional($item->product)->nombreProducto ?? 'Producto no encontrado' }}</td>
                                <td>{{ $item->total_vendido }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Stock Actual -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5>Stock Actual de Productos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Stock Actual</th>
                                <th>Stock Mínimo</th>
                                <th>Diferencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockActual as $producto)
                            <tr>
                                <td>{{ $producto->idProducto }}</td>
                                <td>{{ $producto->nombreProducto }}</td>
                                <td>{{ optional($producto->inventory)->stock_actual ?? 0 }}</td>
                                <td>{{ optional($producto->inventory)->stock_minimo ?? 0 }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $producto->inventory?->stock_actual < $producto->inventory?->stock_minimo ? 'danger' : 'success' }}">
                                        {{ optional($producto->inventory)->stock_actual ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection