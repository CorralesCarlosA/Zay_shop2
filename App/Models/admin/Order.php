<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;
    protected $dates = [ 'fecha_pedido' ];
    protected $casts = [ 
        'fecha_pedido' => 'datetime',
        'recoleccion_en_local' => 'boolean',
        'factura_generada' => 'boolean'
    ];
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

    public function paymentMethod()
    {
        return $this->belongsTo(\App\Models\admin\PaymentMethod::class, 'metodo_pago', 'metodo_pago');
    }
    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function cliente()
    {
        return $this->client();
    }

    // Relación con la ciudad
    public function shippingCity()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad_envio', 'id_ciudad');
    }

    public function City()
    {
        return $this->shippingCity();
    }
    public function ciudad()
    {
        return $this->city();
    }

    public function items()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_pedido');
    }
    // Relación con los detalles del pedido
    public function detalles()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_pedido', 'id_pedido');
    }
    public function details()
    {
        return $this->detalles();
    }

    // Método para verificar si se puede eliminar
    public function canBeDeleted()
    {
        return !in_array($this->estado_pedido, [ 'Enviado', 'Entregado' ]);
    }
    public function estadoColor()
    {
        return match ($this->estado_pedido) {
            'En proceso' => 'primary',
            'Enviado' => 'info',
            'Entregado' => 'success',
            'Cancelado' => 'danger',
            default => 'secondary'
        };
    }
}