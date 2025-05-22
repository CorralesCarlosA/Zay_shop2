<!-- resources/views/admin/facturas/pdf.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Factura #{{ $factura->id_factura }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .header {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>ZayShop - Factura #{{ $factura->id_factura }}</h3>
        <p><strong>Fecha:</strong> {{ $factura->fecha_factura }}</p>
    </div>

    <!-- Datos del cliente -->
    <p><strong>Cliente:</strong> {{ $factura->nombre_cliente }} {{ $factura->apellido_cliente }}</p>
    @if ($factura->n_identificacion_cliente)
    <p><strong>ID:</strong> {{ $factura->n_identificacion_cliente }}</p>
    @endif
    @if ($factura->correo_cliente)
    <p><strong>Correo:</strong> {{ $factura->correo_cliente }}</p>
    @endif
    @if ($factura->telefono_cliente)
    <p><strong>Teléfono:</strong> {{ $factura->telefono_cliente }}</p>
    @endif
    @if ($factura->direccion_cliente)
    <p><strong>Dirección:</strong> {{ $factura->direccion_cliente }}</p>
    @endif

    <!-- Datos del administrador -->
    @if ($factura->admin)
    <p><strong>Generado por:</strong> {{ $factura->admin->nombres }} {{ $factura->admin->apellidos }}</p>
    <p><strong>ID Admin:</strong> {{ $factura->admin->n_identificacion }}</p>
    @endif

    <!-- Detalles de productos -->
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->pedido?->details as $detalle)
            <tr>
                <td>{{ optional($detalle->product)->nombreProducto }}</td>
                <td>{{ optional($detalle->size)->nombre_talla ?? 'Única' }}</td>
                <td>{{ optional($detalle->color)->nombreColor ?? 'Sin color' }}</td>
                <td class="text-right">${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td class="text-right">{{ $detalle->cantidad_pedido }}</td>
                <td class="text-right">${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach

            @foreach ($factura->venta?->details as $detalleVenta)
            <tr>
                <td>{{ optional($detalleVenta->product)->nombreProducto }}</td>
                <td>{{ optional($detalleVenta->size)->nombre_talla ?? 'Única' }}</td>
                <td>{{ optional($detalleVenta->color)->nombreColor ?? 'Sin color' }}</td>
                <td class="text-right">${{ number_format($detalleVenta->precio_unitario, 2) }}</td>
                <td class="text-right">{{ $detalleVenta->cantidad_vendida }}</td>
                <td class="text-right">${{ number_format($detalleVenta->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total</th>
                <th class="text-right">${{ number_format($factura->total, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 40px;">Gracias por su compra</p>
</body>

</html>