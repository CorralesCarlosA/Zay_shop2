<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventario_productos';
    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'idProducto',
        'stock_actual',
        'stock_minimo',
        'id_administrador'
    ];

    // Relación con producto
    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
    }

    // Relación con administrador
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
