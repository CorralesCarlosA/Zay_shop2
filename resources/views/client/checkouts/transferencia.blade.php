@extends('client.layouts.app')

@section('title', 'Pago por Transferencia')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Pagar', 'url' => route('client.checkout.index')],
['name' => 'Transferencia']
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Pago por Transferencia</h5>
        </div>
        <div class="card-body text-center">
            <p>Realiza tu transferencia bancaria a:</p>
            <p><strong>Banco:</strong> Banco Bogotá<br>
                <strong>Cuenta:</strong> 1234567890<br>
                <strong>Referencia:</strong> #PEDIDO_{{ now()->timestamp }}
            </p>

            <p>Una vez realices el pago, envíanos el comprobante por mensaje.</p>

            <a href="{{ route('client.checkout.success') }}" class="btn btn-success">He realizado el pago</a>
        </div>
    </div>
</div>
@endsection