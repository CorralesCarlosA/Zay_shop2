@extends('client.layouts.app')

@section('title', 'Pagar con Mercado Pago')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Carrito', 'url' => route('client.carrito.index')],
['name' => 'Mercado Pago']
])

@section('content')
<div class="container-fluid text-center py-5">
    <h2>Pagar con Mercado Pago</h2>
    <p>Confirma tu pago</p>

    <div id="wallet_container"></div>

    <script src="https://sdk.mercadopago.com/js/v2 "></script>
    <script>
        const mp = new MercadoPago("{{ env('MERCADOPAGO_PUBLIC_KEY') }}", {
            locale: "es-CO"
        });

        mp.checkout({
            preference: {
                items: [{
                    title: 'Pedido #{{ $pedido->id_pedido }}',
                    quantity: {
                        {
                            $pedido - > details - > sum('cantidad_pedido')
                        }
                    },
                    currency_id: 'COP',
                    unit_price: parseFloat("{{ $pedido->total_pedido }}")
                }],
                back_urls: {
                    success: "{{ route('client.checkout.success') }}",
                    failure: "{{ route('client.checkout.index') }}",
                    pending: "{{ route('client.checkout.index') }}"
                },
                auto_return: "approved",
                external_reference: "{{ $pedido->id_pedido }}",
                notification_url: "{{ route('webhook.mercadopago') }}"
            },
            render: {
                container: "#wallet_container",
                label: "Pagar con Mercado Pago"
            }
        });
    </script>
</div>
@endsection