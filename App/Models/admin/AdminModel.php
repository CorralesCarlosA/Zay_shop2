<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    // Obtener usuario por correo
    public static function getUsuario($correo)
    {
        return \App\Models\admin\UsuariosModel::where('correo', $correo)->first();
    }

    // Obtener total de pedidos en cierto estado
    public static function getTotales($estado)
    {
        return \App\Models\admin\PedidosModel::where('proceso', $estado)->count();
    }

    // Obtener cantidad total de productos activos
    public static function getProductos()
    {
        return \App\Models\admin\ProductosModel::where('estado', 1)->count();
    }

    // Obtener productos con cantidad menor a 15
    public static function productosMinimos()
    {
        return \App\Models\admin\ProductosModel::where('cantidad', '<', 15)
            ->where('estado', 1)
            ->orderBy('cantidad', 'DESC')
            ->limit(3)
            ->get();
    }

    // Obtener los productos más vendidos
    public static function topProductos()
    {
        return \App\Models\admin\DetallePedido::selectRaw('producto, SUM(cantidad) AS total')
            ->groupBy('id_producto')
            ->orderBy('total', 'DESC')
            ->limit(3)
            ->get();
    }
}
