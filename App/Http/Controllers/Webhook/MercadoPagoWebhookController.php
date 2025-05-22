<?php

namespace App\Http\Controllers\Webhook;

use App\Models\admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\client\Client;

class MercadoPagoWebhookController extends \App\Http\Controllers\Controller
{
    public function handle(Request $request)
    {
        Log::info('Webhook - Mercado Pago', $request->all());

        $data = $request->input('data');
        $topic = $request->input('type');

        if ($topic === 'payment') {
            $paymentId = $data['id'];

            // Obtener detalles del pago (opcional si usas SDK)
            $mp = new Client();
            $payment = $mp->get($paymentId);

            if ($payment && $payment->status === 'approved') {
                $pedido = Order::where('id_pedido', $payment->external_reference)->first();

                if ($pedido) {
                    $pedido->estado_pedido = 'Pagado';
                    $pedido->save();
                }
            }
        }

        return response('', 200);
    }
}
