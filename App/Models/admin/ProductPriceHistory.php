<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceHistory extends Model
{
    use HasFactory;

    protected $table = 'historial_precios';
    protected $primaryKey = 'id_historial';
    public $timestamps = false;

    protected $fillable = [
        'idProducto',
        'precio_anterior',
        'precio_nuevo',
        'fecha_cambio',
        'hora_cambio',
        'id_administrador'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
