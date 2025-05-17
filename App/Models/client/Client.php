<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_identificacion',
        'n_identificacion',
        'correoE',
        'tipo_cliente',
        'n_telefono',
        'Direccion_recidencia',
        'sexo',
        'estatura(m)',
        'password',
        'ciudad',
        'id_administrador',
        'estado_cliente',
        'fecha_registro'
    ];

    // Relaciones
    public function city()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad', 'id_ciudad');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }

    public function cartItems()
    {
        return $this->hasMany(\App\Models\client\Cartltem::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function favorites()
    {
        return $this->hasMany(\App\Models\client\Favorite::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\client\Order::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function returns()
    {
        return $this->hasMany(\App\Models\client\ReturnProduct::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\client\Message::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\client\Notification::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
