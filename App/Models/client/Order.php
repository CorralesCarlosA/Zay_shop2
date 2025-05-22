<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'n_identificacion_cliente',
        'fecha_pedido',
        'estado_pedido',
        'direccion_envio',
        'ciudad_envio',
        'total_pedido',
        'metodo_pago',
        'recoger_en_tienda'
    ];

    // Relaciones
    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function details()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_pedido', 'id_pedido');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad_envio', 'id_ciudad');
    }
}
