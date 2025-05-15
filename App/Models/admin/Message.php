<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'mensajes_soporte';
    protected $primaryKey = 'id_mensaje';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'id_administrador',
        'asunto',
        'mensaje',
        'estado_mensaje',
        'fecha_envio',
        'hora_envio',
        'respuesta',
        'fecha_respuesta',
        'hora_respuesta'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
