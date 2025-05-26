<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\admin\FavoriteClient as Favorite;
class Client extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion';
    public $incrementing = false; // PK no auto-incremental
    protected $keyType = 'string'; // n_identificacion es string (varchar)
    public $timestamps = false;

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
        'id_administrador'
    ];

    /**
     * Relación con administrador
     */
    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'id_administrador', 'id_administrador');
    }

    /**
     * Relación con ciudad
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'ciudad', 'id_ciudad');
    }

    /**
     * Relación con carrito de compras
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Relación con pedidos
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Relación con favoritos
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    /**
     * Relación con notificaciones
     */
    public function notifications()
    {
        return $this->hasMany(ClientNotification::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}