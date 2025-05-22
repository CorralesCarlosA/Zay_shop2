<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Sale;
use App\Models\admin\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Models\client\Notification;
use Illuminate\Http\Request;

class InvoiceController extends \App\Http\Controllers\Controller
{
    /**
     * Generar factura PDF desde venta
     */
    public function generate(int $id_venta)
    {
        $venta = Sale::with(['items.product', 'client'])->findOrFail($id_venta);

        // Crear factura en BD (opcional)
        $factura = Invoice::firstOrCreate(
            ['id_venta' => $venta->id_venta],
            [
                'fecha_emision' => now(),
                'total_venta' => $venta->total_venta,
                'metodo_pago' => $venta->metodo_pago,
                'n_identificacion_cliente' => $venta->n_identificacion_cliente,
                'id_administrador' => session('admin.id_administrador')
            ]
        );

        $pdf = Pdf::loadView('admin.reportes.ventas.invoice', compact('venta'));

        return $pdf->download("factura-{$venta->id_venta}.pdf");
    }

    /**
     * Mostrar factura en pantalla (no descargar)
     */
    public function show(int $id_venta)
    {
        $venta = Sale::with(['items.product', 'client'])->findOrFail($id_venta);
        return view('admin.reportes.ventas.invoice', compact('venta'));
    }

    /**
     * Enviar factura por correo al cliente
     */
    public function sendToClient(int $id_venta)
    {
        // Cargar venta con productos y cliente
        $venta = Sale::with(['items.product', 'client'])->findOrFail($id_venta);

        // Validar que el cliente tenga correo
        if (!$venta->client || !$venta->client->correoE) {
            return back()->withErrors(['error' => 'El cliente no tiene un correo válido']);
        }

        // Generar PDF
        $pdf = Pdf::loadView('admin.reportes.ventas.invoice', compact('venta'));

        try {
            // Enviar correo con adjunto
            Mail::to($venta->client->correoE)
                ->send(new InvoiceMail($venta, $pdf->output(), "factura-{$venta->id_venta}.pdf"));

            return back()->with('success', 'Factura enviada correctamente por correo');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al enviar la factura: ' . $e->getMessage());
        }
    }

    /**
     * Generar factura desde webhook
     */
    public function generateFromWebhook(Request $request)
    {
        $data = $request->validate([
            'id_venta' => 'required|int|exists:ventas,id_venta'
        ]);

        $venta = Sale::with(['items.product'])->findOrFail($data['id_venta']);

        $factura = Invoice::create([
            'id_venta' => $venta->id_venta,
            'fecha_emision' => now(),
            'total_venta' => $venta->total_venta,
            'metodo_pago' => $venta->metodo_pago,
            'estado_venta' => 'Completada',
            'n_identificacion_cliente' => $venta->n_identificacion_cliente,
            'id_administrador' => session('admin.id_administrador')
        ]);

        // Notificación al cliente
        Notification::create([
            'n_identificacion_cliente' => $venta->n_identificacion_cliente,
            'titulo' => 'Factura Generada',
            'mensaje' => "Tu factura #{$factura->id_factura} está lista.",
            'tipo_notificacion' => 'Factura',
            'leido' => 0,
            'fecha_envio' => now()
        ]);

        return redirect()->route('client.checkout.success')->with('success', 'Gracias por tu compra. Tu factura ha sido generada.');
    }
}