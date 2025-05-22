<?php

namespace App\Http\Controllers\Webhook;

use Illuminate\Http\Request;
use App\Models\admin\Sale;
use App\Models\admin\Invoice;
use App\Models\admin\Message;
use App\Models\admin\Notification;
use App\Models\client\Notification as NotificationClient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class PayPalWebhookController extends \App\Http\Controllers\Controller
{
    /**
     * Manejar webhook de PayPal
     */
    public function handle(Request $request)
    {
        // Validar datos del webhook
        $data = $request->validate([
            'event_type' => 'required|string',
            'resource.*' => 'required'
        ]);

        if ($data['event_type'] !== 'CHECKOUT.ORDER.APPROVED') {
            return response()->json(['status' => 'not_approved']);
        }

        $resource = $request->input('resource');

        // Buscar venta existente o crear nueva
        $venta = Sale::where('id_venta_externa', $resource['id'])->first();

        if (!$venta) {
            $venta = Sale::create([
                'n_identificacion_cliente' => $resource['payer']['email_address'],
                'total_venta' => $resource['purchase_units'][0]['amount']['value'],
                'estado_venta' => 'Completada',
                'metodo_pago' => 'PayPal',
                'fecha_venta' => now(),
                'id_venta_externa' => $resource['id']
            ]);
        }

        // Crear factura si no existe
        Invoice::firstOrCreate(
            ['id_venta' => $venta->id_venta],
            [
                'fecha_emision' => now(),
                'total_venta' => $venta->total_venta,
                'metodo_pago' => 'PayPal',
                'estado_venta' => 'Completada',
                'n_identificacion_cliente' => $venta->n_identificacion_cliente,
                'id_administrador' => null
            ]
        );

        // Notificación al cliente
        NotificationClient::create([
            'n_identificacion_cliente' => $venta->n_identificacion_cliente,
            'titulo' => 'Pago Aprobado - PayPal',
            'mensaje' => "Tu pago por $" . number_format($venta->total_venta, 2) . " fue procesado.",
            'tipo_notificacion' => 'Factura',
            'leido' => 0,
            'fecha_envio' => now()
        ]);

        // Mensaje automático al soporte (opcional)
        Message::create([
            'n_identificacion_cliente' => $venta->n_identificacion_cliente,
            'asunto' => 'Pago Completado - PayPal',
            'mensaje' => "El cliente ha completado el pago por $" . number_format($venta->total_venta, 2) . " usando PayPal.",
            'fecha_envio' => now(),
            'estado_mensaje' => 'Abierto'
        ]);

        return redirect()->route('client.checkout.success')
            ->with('success', 'Gracias por tu compra. Tu factura ha sido generada.');
    }
}
