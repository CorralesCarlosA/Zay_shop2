<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\FavoriteClient as Favorite;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion';

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
        'email_verified_at'
    ];

    // Relación con ciudad
    public function city()
    {
        return $this->belongsTo(\App\Models\admin\City::class, 'ciudad', 'id_ciudad');
    }

    // Relación con mensajes de soporte
    public function messages()
    {
        return $this->hasMany(\App\Models\admin\Message::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con cupones usados
    public function usedCoupons()
    {
        return $this->hasMany(\App\Models\admin\CouponUsed::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con carrito
    public function cartItems()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con favoritos
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con pedidos
    public function orders()
    {
        return $this->hasMany(\App\Models\admin\Order::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
