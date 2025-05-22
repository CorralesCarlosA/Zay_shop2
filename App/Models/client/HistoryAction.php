<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAction extends Model
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
        'ip_cliente',
        'hora_accion',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
