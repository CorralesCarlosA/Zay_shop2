<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'idProducto',
        'cantidad',
        'fecha_agregado'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
    }
}
