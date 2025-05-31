<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura #{{ $pedido->id_pedido }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { text-align: right; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura #{{ $pedido->id_pedido }}</h1>
        <p>Fecha: {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="info">
        <h3>Datos del Cliente</h3>
        <p><strong>Nombre:</strong> {{ optional($pedido->cliente)->nombres }} {{ optional($pedido->cliente)->apellidos }}</p>
        <p><strong>Identificación:</strong> {{ $pedido->n_identificacion_cliente }}</p>
        <p><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>
    </div>

    <h3>Detalles del Pedido</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->details as $detalle)
            <tr>
                <td>{{ optional($detalle->product)->nombreProducto }}</td>
                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>{{ $detalle->cantidad_pedido }}</td>
                <td>${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total: ${{ number_format($pedido->total_pedido, 2) }}</strong></p>
        <p><strong>Método de Pago:</strong> {{ $pedido->metodo_pago }}</p>
    </div>
</body>
</html>