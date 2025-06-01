<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'administradores';
    protected $primaryKey = 'id_administrador';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'correoE',
        'password',
        'estado_administrador',
        'id_rol_admin',
        'n_identificacion'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relaciones
    public function role()
    {
        return $this->belongsTo(\App\Models\admin\AdminRole::class, 'id_rol_admin', 'id_rol_admin');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'id_administrador', 'id_administrador');
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\admin\Message::class, 'id_administrador', 'id_administrador');
    }

    public function sales()
    {
        return $this->hasMany(\App\Models\admin\Sale::class, 'id_administrador', 'id_administrador');
    }

    public function returns()
    {
        return $this->hasMany(\App\Models\admin\ReturnProduct::class, 'id_administrador', 'id_administrador');
    }
}
