<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'idProducto',
        'id_talla',
        'id_color',
        'cantidad',
        'fecha_agregado'
    ];

    // Relaciones
    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
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
