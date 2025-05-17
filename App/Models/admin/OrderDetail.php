<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'detalles_pedido';
    protected $primaryKey = 'id_detalle_pedido';
    public $timestamps = false;

    protected $fillable = [
        'id_pedido',
        'idProducto',
        'id_talla',
        'id_color',
        'cantidad_pedido',
        'precio_unitario',
        'subtotal'
    ];

    // Relaciones
    public function order()
    {
        return $this->belongsTo(\App\Models\admin\Order::class, 'id_pedido', 'id_pedido');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
    }

    public function size()
    {
        return $this->belongsTo(\App\Models\admin\ProductSize::class, 'id_talla', 'id_talla');
    }

    public function color()
    {
        return $this->belongsTo(\App\Models\admin\ProductColor::class, 'id_color', 'idColor');
    }
}
