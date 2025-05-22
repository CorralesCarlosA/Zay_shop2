<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notificaciones_admins';
    protected $primaryKey = 'id_notificacion';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'mensaje',
        'leido',
        'fecha_creacion',
        'hora_creacion',
        'importante',
        'id_administrador'
    ];

    // Relación con administrador
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
