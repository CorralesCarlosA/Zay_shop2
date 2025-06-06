<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notificaciones_clientes';
    protected $primaryKey = 'id_notificacion'; // ❌ No es `id_notificacion_cliente`
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'titulo',
        'mensaje',
        'tipo_notificacion',
        'leido',
        'importante',
        'fecha_envio',
        'hora_envio',
        'fecha_lectura',
        'hora_lectura',
        'id_administrador'
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
