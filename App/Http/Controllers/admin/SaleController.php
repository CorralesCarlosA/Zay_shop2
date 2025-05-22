<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Sale;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\client\Client;
use App\Models\admin\Administrator;
use App\Models\admin\City;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * Mostrar listado de ventas
     */
    public function index()
    {
        // Ventas por día
        $ventasPorDia = Sale::selectRaw('DATE(fecha_venta) as dia, SUM(total_venta) as total')
            ->where('estado_venta', 'Completada')
            ->groupBy('dia')
            ->orderBy('fecha_venta', 'DESC')
            ->take(7)
            ->get()
            ->map(function ($venta) {
                return [
                    'dia' => $venta->dia,
                    'total' => (float) $venta->total
                ];
            });

        // Ventas anuales agrupadas por mes
        $ventasAnuales = Sale::selectRaw('MONTHNAME(fecha_venta) as mes, SUM(total_venta) as total')
            ->whereYear('fecha_venta', now()->year)
            ->where('estado_venta', 'Completada')
            ->groupBy('mes')
            ->orderByRaw('MIN(fecha_venta)')
            ->get()
            ->keyBy('mes')
            ->mapWithKeys(fn($item) => [$item['mes'] => (float) $item['total']]);

        // Ventas mes actual vs mes anterior
        $ventasMesActual = Sale::whereMonth('fecha_venta', now())
            ->whereYear('fecha_venta', now()->year)
            ->where('estado_venta', 'Completada')
            ->sum('total_venta');

        $ventasMesAnterior = Sale::whereMonth('fecha_venta', now()->subMonth())
            ->whereYear('fecha_venta', now()->year)
            ->where('estado_venta', 'Completada')
            ->sum('total_venta');

        // Promedios
        $totalVentas = Sale::where('estado_venta', 'Completada')->sum('total_venta');
        $cantidadVentas = Sale::where('estado_venta', 'Completada')->count();

        $promedioMensual = $cantidadVentas > 0 ? $totalVentas / now()->month : 0;
        $promedioDiario = $cantidadVentas > 0 ? $totalVentas / $cantidadVentas : 0;

        // Pasar variables a la vista
        return view('admin.reportes.ventas.index', compact(
            'ventasPorDia',
            'ventasAnuales',
            'ventasMesActual',
            'ventasMesAnterior',
            'promedioMensual',
            'promedioDiario'
        ));
    }

    /**
     * Mostrar detalles de una venta
     */
    public function show(int $id_venta)
    {
        $venta = Sale::with(['client', 'items.product'])->findOrFail($id_venta);
        return view('admin.reportes.ventas.show', compact('venta'));
    }
}
