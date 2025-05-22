<!-- resources/views/emails/invoice/client.blade.php -->

<h2>Hola {{ optional($venta->client)->nombres }}, ¡Gracias por tu compra!</h2>

<p>Tu factura ha sido generada. Adjunto encontrarás el documento completo.</p>

<p>Si tienes alguna duda, no dudes en contactarnos.</p>