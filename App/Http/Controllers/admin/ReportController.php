<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Sale;
use App\Models\admin\Product;
use App\Models\admin\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends \App\Http\Controllers\Controller
{
    /**
     * Reporte de ventas (general)
     */
    public function indexVentas(Request $request)
    {
        // Rango de fechas
        $fechaInicio = $request->input('fecha_inicio') ?? now()->startOfMonth()->format('Y-m-d');
        $fechaFin = $request->input('fecha_fin') ?? now()->endOfMonth()->format('Y-m-d');

        // Total de ventas en el periodo
        $totalVentas = Sale::whereBetween('fecha_venta', [$fechaInicio, $fechaFin])->sum('total_venta');

        // Ventas por día
        $ventasPorDia = Sale::select(
            DB::raw("DATE(fecha_venta) as dia"),
            DB::raw("SUM(total_venta) as total")
        )
            ->whereBetween('fecha_venta', [$fechaInicio, $fechaFin])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        // Ventas este mes vs meses anteriores
        $ventasMesActual = Sale::whereYear('fecha_venta', now()->year)
            ->whereMonth('fecha_venta', now()->month)
            ->sum('total_venta');

        $ventasMesAnterior = Sale::whereYear('fecha_venta', now()->subMonth()->year)
            ->whereMonth('fecha_venta', now()->subMonth()->month)
            ->sum('total_venta');

        // Promedio mensual (sin incluir el mes actual)
        $promedioMensual = Sale::where('fecha_venta', '<', now()->startOfMonth())
            ->avg('total_venta');

        // Ventas anuales por mes
        $ventasAnuales = Sale::select(
            DB::raw("MONTHNAME(fecha_venta) as mes"),
            DB::raw("SUM(total_venta) as total")
        )
            ->whereYear('fecha_venta', now()->year)
            ->groupBy(DB::raw("MONTH(fecha_venta)"))
            ->pluck('total', 'mes')->toArray();

        // Promedio diario histórico
        $promedioDiario = Sale::avg('total_venta');

        return view('admin.reportes.ventas.index', compact(
            'ventasPorDia',
            'ventasAnuales',
            'ventasMesActual',
            'ventasMesAnterior',
            'promedioMensual',
            'promedioDiario',
            'totalVentas',
            'fechaInicio',
            'fechaFin'
        ));
    }

    /**
     * Reporte detallado de ventas
     */
    public function detalleVenta(int $id_venta)
    {
        $venta = Sale::with(['items.product'])->findOrFail($id_venta);
        return view('admin.reportes.ventas.show', compact('venta'));
    }

    /**
     * Reporte de inventario
     */
    public function indexInventario()
    {
        $stockBajo = Product::with(['inventory'])
            ->whereHas('inventory', fn($q) => $q->whereColumn('stock_actual', '<', 'stock_minimo'))
            ->get();

        $masVendidos = OrderDetail::with(['product'])
            ->select('idProducto', DB::raw('SUM(cantidad_pedido) as total_vendido'))
            ->groupBy('idProducto')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        $stockActual = Product::with(['inventory'])->get();

        return view('admin.reportes.inventario.index', compact('stockBajo', 'masVendidos', 'stockActual'));
    }
}
