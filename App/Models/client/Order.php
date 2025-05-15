<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'direccion_envio',
        'ciudad_envio',
        'total_pedido',
        'estado_pedido',
        'fecha_pedido',
        'hora_pedido'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function shippingCity()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad_envio', 'id_ciudad');
    }
}
