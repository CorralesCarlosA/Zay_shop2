<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'n_identificacion_cliente',
        'fecha_venta',
        'total_venta',
        'estado_venta',
        'metodo_pago',
        'recoger_en_tienda',
        'id_administrador'
    ];

    // Relación con cliente
    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con detalles de venta
    public function saleDetails()
    {
        return $this->hasMany(\App\Models\admin\SaleDetail::class, 'id_venta', 'id_venta');
    }

    // Relación con administrador
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
