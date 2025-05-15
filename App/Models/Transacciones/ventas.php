<?php

namespace App\Models\Transacciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Administrador;

class ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'n_identificacion_cliente',
        'fecha_venta',
        'total_venta',
        'estado_venta',
        'metodo_pago',
        'id_administrador',
    ];

    // Relación con el administrador
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador', 'id_administrador');
    }

    // Relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
