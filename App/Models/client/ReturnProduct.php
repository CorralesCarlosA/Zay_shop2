<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

    protected $table = 'devoluciones';
    protected $primaryKey = 'id_devolucion';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'n_identificacion_cliente',
        'motivo_devolucion',
        'estado_devolucion',
        'fecha_solicitud',
        'hora_solicitud',
        'comentarios_cliente',
        'comentarios_administrador',
        'id_administrador'
    ];

    public function sale()
    {
        return $this->belongsTo(\App\Models\admin\Sale::class, 'id_venta', 'id_venta');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }

    public function product()
    {
        return $this->hasOneThrough(
            \App\Models\admin\Product::class,
            \App\Models\admin\Sale::class,
            'id_venta',     // Foreign key en Sale
            'idProducto',   // Foreign key en Product
            'id_venta',     // Local key en ReturnProduct
            'idProducto'    // Local key en Sale
        );
    }
}
