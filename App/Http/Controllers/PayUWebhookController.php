<?php

namespace App\Http\Controllers\Webhook;

use App\Models\admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                'firma_esperada' => $firma_generada,
                'firma_recibida' => $firma_cadena,
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

        // Cambiar estado según el código de respuesta
        switch ($state) {
            case '4': // Aprobado
                $pedido->estado_pedido = 'Pagado';
                break;
            case '6': // Rechazado
            case '10': // Anulado
            case '11': // Pendiente
                $pedido->estado_pedido = 'Cancelado';
                break;
            default:
                $pedido->estado_pedido = 'En proceso';
                break;
        }

        $pedido->save();

        Log::info('Estado actualizado desde PayU', [
            'pedido_id' => $pedido->id_pedido,
            'nuevo_estado' => $pedido->estado_pedido,
            'metodo_pago' => 'PayU'
        ]);

        // Devolver respuesta exitosa a PayU
        return response("OK", 200);
    }
}
