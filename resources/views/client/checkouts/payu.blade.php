@extends('client.layouts.app')

@section('title', 'Pagar con PayU')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Pagar', 'url' => route('client.checkout.index')],
['name' => 'PayU']
])

@section('content')
<div class="container-fluid text-center py-5">
    <h2>Procesando pago con PayU</h2>
    <p>Estás siendo redirigido a la pasarela de PayU...</p>

    <form action="https://sandbox.payulatam.com " method="POST">
        <input type="hidden" name="merchantId" value="TU_MERCHANT_ID">
        <input type="hidden" name="accountId" value="TU_ACCOUNT_ID">
        <input type="hidden" name="description" value="Compra en tu tienda">
        <input type="hidden" name="referenceCode" value="{{ now()->timestamp }}">
        <input type="hidden" name="amount" value="{{ session('cart_total') }}">
        <input type="hidden" name="tax" value="0">
        <input type="hidden" name="taxReturnBase" value="0">
        <input type="hidden" name="currency" value="COP">
        <input type="hidden" name="signature" value="FIRMA_GENERADA">
        <input type="hidden" name="test" value="1">
        <input type="hidden" name="buyerEmail" value="{{ session('client.correoE') }}">

        <button type="submit" class="btn btn-lg btn-info">Ir a PayU</button>
    </form>
</div>
@endsection