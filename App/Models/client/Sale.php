<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'total_venta',
        'estado_venta',
        'metodo_pago',
        'direccion_envio',
        'ciudad_envio',
        'fecha_venta',
        'hora_venta',
        'id_administrador'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad_envio', 'id_ciudad');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
