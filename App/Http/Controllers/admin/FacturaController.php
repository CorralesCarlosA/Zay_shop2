<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Order;
use App\Models\admin\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FacturaController extends Controller
{
    public function generateFromOrder(Request $request, $id_pedido)
    {
        // 1. Obtener el pedido con relaciones necesarias
        $pedido = Order::with(['cliente', 'details.product'])->findOrFail($id_pedido);
        
        // 2. Verificar si ya tiene factura
        if ($pedido->factura_generada) {
            return back()->with('error', 'Este pedido ya tiene factura generada');
        }

        // 3. Generar PDF de la factura
        $pdf = PDF::loadView('admin.facturas.pdf', compact('pedido'));
        
        // 4. Guardar el PDF en storage
        $pdfPath = 'facturas/factura-'.$pedido->id_pedido.'.pdf';
        Storage::put($pdfPath, $pdf->output());
        
        // 5. Crear registro de factura
        $factura = Factura::create([
            'id_pedido' => $pedido->id_pedido,
            'n_identificacion_cliente' => $pedido->n_identificacion_cliente,
            'nombre_cliente' => optional($pedido->cliente)->nombres,
            'apellido_cliente' => optional($pedido->cliente)->apellidos,
            'correo_cliente' => optional($pedido->cliente)->correoE,
            'telefono_cliente' => optional($pedido->cliente)->n_telefono,
            'direccion_cliente' => $pedido->direccion_envio,
            'metodo_pago' => $pedido->metodo_pago,
            'total' => $pedido->total_pedido,
            'estado_factura' => 'Pagada',
            'id_administrador' => auth()->id(),
            'pdf_path' => $pdfPath
        ]);

        // 6. Actualizar el pedido
        $pedido->update(['factura_generada' => true]);

        // 7. Redireccionar con opción de descargar
        return redirect()
               ->route('admin.pedidos.show', $pedido->id_pedido)
               ->with([
                   'success' => 'Factura generada correctamente',
                   'download_url' => route('admin.facturas.download', $factura->id_factura)
               ]);
    }

    public function download($id_factura)
    {
        $factura = Factura::findOrFail($id_factura);
        return Storage::download($factura->pdf_path);
    }
}