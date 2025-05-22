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
        'recoleccion_en_local',
        'factura_generada'
    ];

    // Relación con cliente
    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con detalles del pedido
    public function details()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_pedido', 'id_pedido')
            ->with(['product.color', 'product.size']);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(\App\Models\admin\PaymentMethod::class, 'metodo_pago', 'metodo_pago');
    }

    // Relación con ciudad
    public function city()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad_envio', 'id_ciudad');
    }

    // Verificar si puede ser eliminado
    public function canBeDeleted(): bool
    {
        return !in_array($this->estado_pedido, ['Enviado', 'Entregado']);
    }
}
