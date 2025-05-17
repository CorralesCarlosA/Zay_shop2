<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

    protected $table = 'devoluciones';
    protected $primaryKey = 'id_devolucion';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'id_venta',
        'idProducto',
        'id_talla',
        'id_color',
        'motivo_devolucion',
        'estado_devolucion',
        'fecha_solicitud',
        'hora_solicitud',
        'comentarios_cliente',
        'comentarios_administrador',
        'id_administrador'
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
