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
        // Obtener pedidos recientes con sus relaciones
        $pedidosRecientes = Order::with([
            'cliente' => function($query) {
                $query->select('n_identificacion', 'nombres', 'apellidos');
            },
            'detalles'
        ])
        ->orderBy('fecha_pedido', 'desc')
        ->limit(5)
        ->get();
            $recentCustomers = Client::latest()
                            ->take(5)
                            ->get();

        // Obtener datos para la gráfica de ventas (últimos 6 meses)
        $ventasMensuales = Sale::selectRaw('
            YEAR(fecha_venta) as year,
            MONTH(fecha_venta) as month,
            SUM(total_venta) as total,
            COUNT(*) as count
        ')
        ->where('fecha_venta', '>=', Carbon::now()->subMonths(6))
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        // Preparar datos para la gráfica (últimos 6 meses)
        $ventasChartData = [];
        $mesesLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;
            $mesesLabels[] = $date->format('M Y');
            
            $venta = $ventasMensuales->first(function ($item) use ($month, $year) {
                return $item->month == $month && $item->year == $year;
            });
            
            $ventasChartData[] = $venta ? (float)$venta->total : 0;
        }

        return view('admin.dashboard.index', [
            'totalProductos' => Product::where('idEstadoProducto', 1)->count(),
            'totalVentas' => Sale::sum('total_venta'),
            'ventasHoy' => Sale::whereDate('fecha_venta', Carbon::today())->sum('total_venta'),
            'pedidosPendientes' => Order::where('estado_pedido', 'En proceso')->count(),
            'productosSinStock' => Product::has('inventario', '<=', 0)->limit(5)->get(),
            'clientesRecientes' => Client::whereDate('fecha_registro', Carbon::today())->limit(5)->get(),
            'pedidosRecientes' => $pedidosRecientes,
            'ventasChartData' => $ventasChartData,
            'mesesLabels' => $mesesLabels,
        'recentOrders' => DB::table('pedidos')
                          ->join('clientes', 'pedidos.n_identificacion_cliente', '=', 'clientes.n_identificacion')
                          ->select(
                              'pedidos.*', 
                              'clientes.nombres as nombre_cliente',
                              'clientes.apellidos as apellido_cliente'
                          )
                          ->orderBy('fecha_pedido', 'desc')
                          ->take(5)
                          ->get(),

                
                        'outOfStockProducts' => DB::table('productos')
                        ->where('cantidadDisponible', '<=', 5) // Umbral de bajo stock
                        ->orderBy('cantidadDisponible', 'asc')
                        ->take(15)
                        ->get()
                        ->select(
                            'idProducto',
                            'nombreProducto',
                            'cantidadDisponible',
                            'precioProducto',
                            'codigoIdentificador',
                            'id_categoria',
                        ),
  'recentCustomers' => DB::table('clientes')
                    ->select([
                        'n_identificacion',
                        'nombres',
                        'apellidos',
                        'n_telefono',
                        'correoE',
                        'fecha_registro',
                        'tipo_cliente',
                        'ciudad'
                    ])
                    ->orderBy('fecha_registro', 'desc')
                    ->take(5)
                    ->get()
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