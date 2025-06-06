<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'cupones_descuento';
    protected $primaryKey = 'id_cupon';
    public $timestamps = false;

    protected $fillable = [
        'nombre_cupon',
        'codigo_cupon',
        'tipo_descuento',
        'valor',
        'fecha_expiracion',
        'activo',
        'cantidad_productos_minimos'
    ];
}
