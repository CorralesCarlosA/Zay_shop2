<?php


namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'clientes'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'n_identificacion'; // Llave primaria de la tabla

    public $incrementing = false; // Indica que la llave primaria no es autoincremental

    protected $keyType = 'string'; // Tipo de la llave primaria

    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_identificacion',
        'n_identificacion',
        'estado_cliente',
        'tipo_cliente',
        'n_telefono',
        'Direccion_recidencia',
        'correoE',
        'sexo',
        'estatura(m)',
        'fecha_registro',
        'password',
        'ciudad',
        'id_administrador',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
        'estado_cliente' => 'boolean',
    ];

    // Relación con la tabla ciudades
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad', 'id_ciudad');
    }

    // Relación con la tabla administradores
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador', 'id_administrador');
    }
}