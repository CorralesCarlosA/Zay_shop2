<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'metodos_pago';
    protected $primaryKey = 'id_metodo_pago';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'tipo',
        'activo',
        'descripcion',
        'configuracion_adicional',
        'fecha_registro',
        'id_administrador'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'configuracion_adicional' => 'array',
        'fecha_registro' => 'datetime',
    ];

    // Relación con administradores
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }

    // Relación con ventas
    public function sales()
    {
        return $this->hasMany(\App\Models\admin\Sale::class, 'metodo_pago_id', 'id_metodo_pago');
    }

    // Relación con pedidos
    public function orders()
    {
        return $this->hasMany(\App\Models\admin\Order::class, 'metodo_pago_id', 'id_metodo_pago');
    }
}