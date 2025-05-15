<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'mensajes_soporte';
    protected $primaryKey = 'id_mensaje';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'asunto',
        'mensaje',
        'estado_mensaje',
        'fecha_envio',
        'hora_envio',
        'id_administrador',
        'respuesta',
        'fecha_respuesta',
        'hora_respuesta'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
