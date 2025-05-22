<!-- resources/views/emails/invoice/client.blade.php -->

<h3>Hola {{ optional($venta->client)->nombres }},</h3>

<p>Tu pago ha sido procesado con éxito.</p>

<p>Tu factura #{{ $facturaId }} ya está disponible en tu perfil para revisarla o descargarla.</p>

<p>Puedes acceder a ella desde <a href="{{ route('client.facturas.show', $venta->id_venta) }}">aquí</a>.</p>

<hr>

<p><strong>Total:</strong> ${{ number_format($venta->total_venta, 2) }}</p>
<p><strong>Método de pago:</strong> {{ $venta->metodo_pago }}</p>
<p><strong>Fecha:</strong> {{ now()->format('d/m/Y H:i') }}</p>

<hr>

<p>Si tienes alguna duda, no dudes en contactarnos.</p>