<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'detalles_venta';
    protected $primaryKey = 'id_detalle_venta';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'idProducto',
        'id_talla',
        'id_color',
        'cantidad_vendida',
        'precio_unitario',
        'subtotal'
    ];

    // Relaciones
    public function sale()
    {
        return $this->belongsTo(\App\Models\admin\Sale::class, 'id_venta', 'id_venta');
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
