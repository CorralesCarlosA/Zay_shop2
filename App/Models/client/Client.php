<?php

namespace App\Models\Client;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Client extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_identificacion',
        'n_identificacion',
        'correoE',
        'password',
        'sexo',
        'n_telefono',
        'Direccion_recidencia',
        'ciudad',
        'estado_cliente',
        'tipo_cliente',
        'email_verified_at',
        'estatura(m)',
        'fecha_registro',
        'id_administrador'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_registro' => 'datetime',
        'estado_cliente' => 'boolean',
    ];

    /**
     * Automatically hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'correoE';
    }

    // Relación con ciudad
    public function city()
    {
        return $this->belongsTo(\App\Models\Admin\City::class, 'ciudad', 'id_ciudad');
    }

    // Relación con mensajes de soporte
    public function messages()
    {
        return $this->hasMany(\App\Models\Admin\Message::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con cupones usados
    public function usedCoupons()
    {
        return $this->hasMany(\App\Models\Admin\CouponUsed::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con carrito
    public function cartItems()
    {
        return $this->hasMany(\App\Models\Admin\CartItem::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con favoritos
    public function favorites()
    {
        return $this->hasMany(\App\Models\Admin\FavoriteClient::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con pedidos
    public function orders()
    {
        return $this->hasMany(\App\Models\Admin\Order::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Check if client is active
     */
    public function isActive()
    {
        return $this->estado_cliente === 1;
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}