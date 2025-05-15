<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class PedidosModel extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['proceso'];
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Obtener pedidos según el proceso usando scope
    public function scopeGetPedidos($query, $proceso)
    {
        return $query->where('proceso', $proceso);
    }

    // Actualizar estado del pedido como método de instancia
    public function actualizarEstado($proceso)
    {
        $this->update(['proceso' => $proceso]);
    }
}
