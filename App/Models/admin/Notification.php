<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notificaciones_admins';
    protected $primaryKey = 'id_notificacion';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'mensaje',
        'leido',
        'fecha_creacion',
        'hora_creacion',
        'importante'
    ];
}
