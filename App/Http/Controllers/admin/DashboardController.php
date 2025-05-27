<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use App\Models\admin\Order;
use App\Models\admin\Client;
use App\Models\admin\Sale;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Muestra el panel de control del administrador
     */
    public function index()
    {
        // Contadores principales
        $totalProductos = Product::count();
        $totalVentas = Sale::sum('total_venta');
        $ventasHoy = Sale::whereDate('fecha_venta', now())->sum('total_venta');
        $pedidosPendientes = Order::where('estado_venta', 'Pendiente')->count();

        // Ventas mensuales (últimos 6 meses)
        $ventasMensuales = Sale::selectRaw('MONTH(fecha_venta) as mes, SUM(total_venta) as total')
            ->whereYear('fecha_venta', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total');

        // Clientes recientes (últimos 5)
        $clientesRecientes = Client::latest()->take(5)->get();

        // Productos con bajo stock (menos de 10 unidades)
        $productosSinStock = Product::has('inventario', '<', 10)->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalProductos',
            'totalVentas',
            'ventasHoy',
            'pedidosPendientes',
            'ventasMensuales',
            'clientesRecientes',
            'productosSinStock'
        ));
    }
}