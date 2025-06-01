<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
protected $namespace = 'App\\Http\\Controllers';

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    public $timestamps = false;

    protected $fillable = [
        'id_pedido',
        'id_venta',
        'n_identificacion_cliente',
        'nombre_cliente',
        'apellido_cliente',
        'correo_cliente',
        'telefono_cliente',
        'direccion_cliente',
        'metodo_pago',
        'total',
        'estado_factura',
        'id_administrador',
        'notas',
        'pdf_path'
    ];

    // Relación con Pedido
    public function pedido()
    {
        return $this->belongsTo(\App\Models\admin\Order::class, 'id_pedido', 'id_pedido');
    }

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(\App\Models\admin\Sale::class, 'id_venta', 'id_venta');
    }

    // Relación con Cliente (opcional si está registrado)
    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con Administrador
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
