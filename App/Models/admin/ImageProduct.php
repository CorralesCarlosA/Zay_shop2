<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ImageProduct extends Model
{
    use HasFactory;

    protected $table = 'imagenes_producto';
    protected $primaryKey = 'id_imagen';

    protected $fillable = [
        'id_producto',
        'url_imagen',
        'orden'
    ];

    // Relación con Producto
    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'id_producto', 'idProducto');
    }
}