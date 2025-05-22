<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Product;
use App\Models\admin\Order;
use Illuminate\Http\Request;

class DashboardController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $totalProductos = Product::count();
        $totalVentas = Order::sum('total_pedido');
        $ventasHoy = Order::whereDate('fecha_pedido', now())->sum('total_pedido');
        $pedidosPendientes = Order::where('estado_pedido', 'En proceso')->count();

        return view('admin.dashboard.index', compact(
            'totalProductos',
            'totalVentas',
            'ventasHoy',
            'pedidosPendientes'
        ));
    }
}
