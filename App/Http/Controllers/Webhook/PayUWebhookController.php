<?php

namespace App\Http\Controllers\Webhook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\admin\Order;
use App\Models\admin\Sale;
use App\Models\client\Notification as NotificationClient;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\admin\CartItem;
use App\Models\admin\Product;

class PayUWebhookController extends \App\Http\Controllers\Controller
{
    /**
     * Manejar la notificación de PayU
     */
    public function handle(Request $request)
    {
        // Valores comunes enviados por PayU
        $reference = $request->input('reference_sale');
        $value = $request->input('value');
        $currency = $request->input('currency');
        $state = $request->input('state_pol');
        $firma_cadena = $request->input('sign');

        // Tu llave API secreta de PayU (debes tenerla en .env)
        $apiKey = env('PAYU_API_KEY');

        // Verificar firma
        $firma_generada = hash("sha256", "$apiKey~$reference~$value~$state");

        if ($firma_generada !== $firma_cadena) {
            Log::warning('Firma inválida en webhook de PayU', [
                'esperada' => $firma_generada,
                'recibida' => $firma_cadena,
                'data' => $request->all()
            ]);

            return response('Firma no válida', 400);
        }

        // Buscar el pedido
        $pedido = Order::where('id_pedido', $reference)->first();

        if (!$pedido) {
            Log::error('Pedido no encontrado en webhook de PayU', ['reference' => $reference]);
            return response('Pedido no encontrado', 404);
        }

        // Actualizar estado del pedido según PayU
        switch ($state) {
            case '4': // Aprobado
                $pedido->estado_pedido = 'Pagado';
                break;
            case '6': // Rechazado
            case '10': // Anulado
            case '11': // Pendiente o fallido
                $pedido->estado_pedido = 'Cancelado';
                break;
            default:
                $pedido->estado_pedido = 'En proceso';
                break;
        }

        $pedido->save();

        // Si el pago fue exitoso, procedemos a generar factura, notificación y correo
        if ($pedido->estado_pedido === 'Pagado') {

            // Crear venta (si aún no existe una asociada)
            $venta = Sale::where('n_identificacion_cliente', $pedido->n_identificacion_cliente)
                ->where('id_venta_externa', $reference)
                ->first();

            if (!$venta) {
                $venta = Sale::create([
                    'n_identificacion_cliente' => $pedido->n_identificacion_cliente,
                    'total_venta' => $value,
                    'estado_venta' => 'Completada',
                    'metodo_pago' => 'Tarjeta (PayU)',
                    'fecha_venta' => now(),
                    'id_venta_externa' => $reference
                ]);
            }

            // Limpiar carrito del cliente
            CartItem::where('n_identificacion_cliente', $pedido->n_identificacion_cliente)->delete();

            // Crear notificación para el cliente
            NotificationClient::create([
                'n_identificacion_cliente' => $pedido->n_identificacion_cliente,
                'titulo' => 'Pago Exitoso',
                'mensaje' => "Tu pago por $" . number_format($venta->total_venta, 2) . " fue completado.",
                'tipo_notificacion' => 'Factura',
                'leido' => 0,
                'fecha_envio' => now(),
                'hora_creacion' => now()->format('H:i:s'),
                'importante' => 1
            ]);

            // Enviar correo al cliente
            Mail::to($venta->client->correoE)
                ->send(new InvoiceMail($venta, $venta->id_venta));

            // Opcional: actualizar stock de productos vendidos
            foreach ($pedido->details as $detalle) {
                $producto = Product::find($detalle->idProducto);
                if ($producto && $producto->inventory) {
                    $inventario = $producto->inventory;
                    $inventario->stock_actual -= $detalle->cantidad_pedido;
                    $inventario->save();
                }
            }
        }

        Log::info('Estado actualizado desde PayU', [
            'pedido_id' => $pedido->id_pedido,
            'nuevo_estado' => $pedido->estado_pedido,
            'cliente' => $pedido->client->nombres ?? 'Desconocido'
        ]);

        // Devolver respuesta exitosa a PayU
        return response("OK", 200);
    }
}