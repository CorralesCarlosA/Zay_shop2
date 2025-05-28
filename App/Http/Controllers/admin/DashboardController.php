<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Administrator;
use App\Models\admin\Order;
use App\Models\admin\Product;
use App\Models\admin\Sale;
use App\Models\admin\Client;
use Illuminate\Support\Carbon;


use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalProductos' => (int) Product::active()->count(),
            'totalVentas' => (float) Sale::sum('total_venta'), // Ajustado a tu nombre de columna
            'ventasHoy' => (float) Sale::whereDate('fecha_venta', today())->sum('total_venta'),
            'pedidosPendientes' => (int) Order::where('estado_pedido', 'En proceso')->count(),
            'productosSinStock' => Product::outOfStock()->limit(5)->get(),
            'clientesRecientes' => Client::whereDate('fecha_registro', today())->limit(5)->get(),
            'ventasChartData' => [
                'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                'data' => $this->getMonthlySalesData()
            ],
            'breadcrumbs' => [
                ['name' => 'Inicio', 'url' => route('admin.dashboard')]
            ]
        ]);
    }

    protected function getMonthlySalesData()
    {
        return Sale::query()
            ->selectRaw('MONTH(fecha_venta) as mes, SUM(total_venta) as total')
            ->whereYear('fecha_venta', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total')
            ->toArray();
    }
}