<?php
namespace App\Models\admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $guard = 'clientes'; 

    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion';
    public $incrementing = false;
     protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nombres', 'apellidos', 'tipo_identificacion', 'n_identificacion',
        'estado_cliente', 'tipo_cliente', 'n_telefono', 'Direccion_recidencia',
        'correoE', 'sexo', 'estatura(m)', 'password', 'ciudad', 'fecha_registro'
    ];

    protected $hidden = [
        'password'
    ];

        public function pedidos()
    {
        return $this->hasMany(Order::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName()
    {
        return 'correoE';
    }
}