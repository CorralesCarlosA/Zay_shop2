<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'fecha_venta',
        'hora_venta',
        'total_venta',
        'estado_venta',
        'metodo_pago',
        'direccion_envio',
        'ciudad_envio',
        'id_administrador'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function shippingCity()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad_envio', 'id_ciudad');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }

    public function items()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_venta', 'id_venta');
    }
}