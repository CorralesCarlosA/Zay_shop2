<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySaleStatus extends Model
{
    use HasFactory;

    protected $table = 'historial_estados_venta';
    protected $primaryKey = 'id_historial_estado_venta';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'estado_venta',
        'fecha_cambio',
        'hora_cambio',
        'id_administrador'
    ];

    public function sale()
    {
        return $this->belongsTo(\App\Models\admin\Sale::class, 'id_venta', 'id_venta');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
