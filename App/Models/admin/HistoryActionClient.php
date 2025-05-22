<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryActionClient extends Model
{
    use HasFactory;

    protected $table = 'historial_acciones_clientes';
    protected $primaryKey = 'id_registro';

    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'accion_realizada',
        'descripcion',
        'fecha_accion',
        'hora_accion',
        'ip_cliente'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
