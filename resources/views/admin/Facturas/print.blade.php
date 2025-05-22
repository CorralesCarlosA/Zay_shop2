<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $venta->id_venta }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2,
        p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        tfoot th {
            text-align: right;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="invoice-box container">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2>Mi Tienda S.A.S.</h2>
                <p>NIT: 900.123.456</p>
            </div>
            <div class="text-end">
                <h4>Factura #{{ $venta->id_venta }}</h4>
                <p><strong>Fecha:</strong> {{ now() }}</p>
            </div>
        </div>

        <hr>

        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Datos del Cliente</h5>
                <p><strong>Nombre:</strong> {{ optional($venta->client)->nombres }}</p>
                <p><strong>Correo:</strong> {{ optional($venta->client)->correoE }}</p>
                <p><strong>Dirección:</strong> {{ optional($venta->client)->Direccion_recidencia }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5>Resumen</h5>
                <p><strong>Total:</strong> ${{ number_format($venta->total_venta, 2) }}</p>
                <p><strong>Método de Pago:</strong> {{ $venta->metodo_pago }}</p>
            </div>
        </div>

        <table class="mt-4">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->items as $item)
                <tr>
                    <td>{{ optional($item->product)->nombreProducto ?? 'Producto Eliminado' }}</td>
                    <td>{{ $item->cantidad_pedido }}</td>
                    <td>${{ number_format($item->precio_unitario, 2) }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th>${{ number_format($venta->total_venta, 2) }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="text-center mt-5">
            <p class="mb-5">¡Gracias por tu compra!</p>
        </div>
    </div>
</body>

</html>