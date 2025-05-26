<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion';
    public $incrementing = false; // PK no es auto-incremental
    public $timestamps = false; // No usamos created_at / updated_at

    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_identificacion',
        'n_identificacion',
        'estado_cliente', // ✅ Aquí sí está incluido
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
        'email_verified_at'
    ];

    /**
     * Relación con administrador (quien registró al cliente)
     */
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }

    /**
     * Relación con ciudad
     */
    public function city()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad', 'id_ciudad');
    }

    /**
     * Relación con carrito de compras
     */
    public function cartItems()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Relación con favoritos
     */
    public function favorites()
    {
        return $this->hasMany(\App\Models\client\Favorite::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Relación con pedidos
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\admin\Order::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Relación con notificaciones
     */
    public function notifications()
    {
        return $this->hasMany(\App\Models\client\ClientNotification::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}