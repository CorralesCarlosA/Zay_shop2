<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceMail extends Mailable
{
    use Queueable;

    public $venta;

    public function __construct($venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
        $venta = $this->venta;

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject("Tu factura - #{$venta->id_venta}")
            ->view('admin.reportes.ventas.invoice', ['venta' => $venta])
            ->attachData(
                Pdf::loadView('admin.reportes.ventas.invoice', ['venta' => $venta])->output(),
                "factura-{$venta->id_venta}.pdf",
                [
                    'mime' => 'application/pdf'
                ]
            );
    }
}
