<?php

namespace App\Http\Controllers\Client;

use App\Models\admin\Product;
use App\Models\admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Client\Sale as Sale;

class CheckoutController extends \App\Http\Controllers\Controller
{
    /**
     * Resumen del pedido antes de pagar
     */
    public function index(Request $request)
    {
        $carrito = Session::get('cart', []);
        $productos = [];

        foreach ($carrito as $item) {
            $producto = Product::findOrFail($item['idProducto']);
            $producto->setAttribute('cantidad', $item['cantidad_pedido']);
            $producto->setAttribute('subtotal', $producto->precioProducto * $item['cantidad_pedido']);
            $productos[] = $producto;
        }

        $total = array_sum(array_map(fn($p) => $p->precioProducto * $p->cantidad, $carrito));

        return view('client.checkout.index', compact('productos', 'total'));
    }

    /**
     * Seleccionar método de pago
     */
    public function selectPayment(Request $request)
    {
        $metodoPago = $request->input('metodo_pago');

        if (!in_array($metodoPago, ['Efectivo', 'Tarjeta', 'Transferencia', 'Contraentrega'])) {
            return back()->withErrors(['error' => 'Método de pago no válido']);
        }

        Session::put('payment_method', $metodoPago);
        return redirect()->route('client.checkout.confirm');
    }

    /**
     * Confirmar y procesar el pago según la pasarela
     */


    /**
     * Procesar pago con PayU
     */
    public function processPayU(Request $request)
    {
        // Aquí va la lógica de conexión con PayU (más abajo te doy el formulario)
        return redirect()->route('client.checkout.success')->with('success', 'Pago realizado con PayU');
    }

    /**
     * Procesar pago con Mercado Pago
     */
    public function processMercadoPago(Request $request)
    {
        // Redirección a Mercado Pago SDK
        return redirect()->route('client.checkout.success')->with('success', 'Pago realizado con Mercado Pago');
    }

    /**
     * Procesar pago con PayPal
     */
    public function processPayPal(Request $request)
    {
        // Lógica de SDK de PayPal
        return redirect()->route('client.checkout.success')->with('success', 'Pago realizado con PayPal');
    }

    /**
     * Vista de éxito
     */
    public function success()
    {
        $venta = Sale::latest()->first();

        // Si existe una venta reciente
        if ($venta) {
            // Crear notificación para el admin
            \App\Models\admin\Notification::create([
                'titulo' => 'Nuevo Pago Realizado',
                'mensaje' => "Venta #{$venta->id_venta} - Cliente: {$venta->client->nombres}",
                'fecha_creacion' => now()->toDateString(),
                'hora_creacion' => now()->toTimeString(),
                'importante' => 1
            ]);
        }

        return view('client.checkout.success', compact('venta'));
    }


    /**
     * Guardar pedido y limpiar carrito
     */
    public function storeOrder(Request $request)
    {
        $carrito = Session::get('cart', []);

        if (!$carrito) {
            return back()->withErrors(['error' => 'Tu carrito está vacío']);
        }

        $pedido = Order::create([
            'n_identificacion_cliente' => Session::get('client.n_identificacion'),
            'direccion_envio' => $request->input('direccion_envio'),
            'ciudad_envio' => $request->input('ciudad_envio'),
            'total_pedido' => array_sum(array_map(fn($item) => $item['cantidad_pedido'] * $item['precio_unitario'], $carrito)),
            'metodo_pago' => Session::get('payment_method'),
            'estado_pedido' => 'En proceso'
        ]);

        // Guardar detalles del pedido
        foreach ($carrito as $item) {
            \App\Models\admin\OrderDetail::create([
                'id_pedido' => $pedido->id_pedido,
                'idProducto' => $item['idProducto'],
                'precio_unitario' => $item['precio_unitario'],
                'cantidad_pedido' => $item['cantidad_pedido'],
                'subtotal' => $item['precio_unitario'] * $item['cantidad_pedido']
            ]);
        }

        // Limpiar carrito
        Session::forget('cart');
        return redirect()->route('client.checkout.success')->with('success', 'Pedido realizado correctamente');
    }

    public function confirm(Request $request)
    {
        $metodoPago = Session::get('payment_method');

        if ($metodoPago !== 'Mercado Pago') {
            return back()->withErrors(['error' => 'Método de pago no válido']);
        }

        // Buscar pedido pendiente
        $pedido = Order::where([
            'n_identificacion_cliente' => Session::get('client.n_identificacion'),
            'estado_pedido' => 'En proceso',
            'metodo_pago' => 'Mercado Pago'
        ])->first();

        if (!$pedido) {
            return redirect()->route('client.carrito.index')->with('error', 'No tienes un pedido pendiente con Mercado Pago');
        }

        return view('client.checkout.mercadopago', compact('pedido'));
    }
}