<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';

    protected $fillable = [
        'id_venta',
        'fecha_emision',
        'total_venta',
        'metodo_pago',
        'estado_venta',
        'n_identificacion_cliente',
        'id_administrador'
    ];

    public function sale()
    {
        return $this->belongsTo(\App\Models\admin\Sale::class, 'id_venta', 'id_venta');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
