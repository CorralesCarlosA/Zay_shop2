<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Factura #{{ $venta->id_venta }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .top-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .cliente-info {
            margin-top: 20px;
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
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <div class="invoice-box">

        <!-- Encabezado -->
        <div class="top-info">
            <div>
                <h3>Mi Tienda S.A.S.</h3>
                <p>NIT: 900.123.456</p>
            </div>
            <div class="text-right">
                <h3>Factura #{{ $venta->id_venta }}</h3>
                <p>{{ now()->format('d/m/Y') }}</p>
            </div>
        </div>

        <hr>

        <!-- Datos del cliente -->
        <div class="cliente-info">
            <h5><strong>Cliente:</strong></h5>
            <p>
                {{ optional($venta->client)->nombres }} {{ optional($venta->client)->apellidos }}<br>
                Email: {{ optional($venta->client)->correoE }}<br>
                Dirección: {{ optional($venta->client)->Direccion_recidencia }}
            </p>
        </div>

        <!-- Tabla de productos -->
        <table>
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
                    <td>{{ optional($item->product)->nombreProducto ?? 'Producto eliminado' }}</td>
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

    </div>

</body>

</html>