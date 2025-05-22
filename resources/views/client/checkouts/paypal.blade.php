@extends('client.layouts.app')

@section('title', 'Pagar con PayPal')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Pagar', 'url' => route('client.checkout.index')],
['name' => 'PayPal']
])

@section('content')
<div class="container-fluid text-center py-5">
    <h2>Pagar con PayPal</h2>
    <p>Por favor, completa tu pago</p>

    <div id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=CAD "></script>
    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ session('
                            cart_total ') }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Pago completado por ' + details.payer.name.given_name);
                    window.location.href = "{{ route('client.checkout.success') }}";
                });
            },
            onError: err => {
                console.error(err);
                alert('Hubo un error en el pago');
                window.location.href = "{{ route('client.checkout.index') }}";
            }
        }).render('#paypal-button-container');
    </script>
</div>
@endsection