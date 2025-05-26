<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ClientesModel extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'n_identificacion',
        'nombres',
        'apellidos',
        'correoE',
        'password',
        'sexo',
        'ciudad',
        'estatura(m)',
        'telefono',
        'Direccion_recidencia',
        'id_administrador',
    ];

    // Obtener todas las categorías activas
    public static function getCategorias()
    {
        return \App\Models\admin\CategoriasModel::where('estado', 1)->get();
    }

    // Registrar un cliente nuevo
    public static function registroDirecto($nombre, $correo, $clave, $token)
    {
        return self::create([
            'nombre' => $nombre,
            'correo' => $correo,
            'clave' => bcrypt($clave), // Hash de clave
            'token' => $token
        ]);
    }

    // Obtener cliente por token
    public static function getToken($token)
    {
        return self::where('token', $token)->first();
    }

    // Actualizar verificación del cliente
    public static function actualizarVerify($id)
    {
        return self::where('id', $id)->update([
            'token' => null,
            'verify' => 1
        ]);
    }

    // Verificar si un correo está registrado
    public static function getVerificar($correo)
    {
        return self::where('correo', $correo)->first();
    }

    // Registrar un pedido
    public static function registrarPedido($datos)
    {
        return \App\Models\admin\PedidosModel::create($datos);
    }

    // Obtener un producto por ID
    public static function getProducto($id_producto)
    {
        return \App\Models\admin\ProductosModel::find($id_producto);
    }

    // Registrar detalle de pedido
    public static function registrarDetalle($datos)
    {
        return \App\Models\admin\DetallePedido::create($datos);
    }

    // Obtener todos los pedidos de un cliente
    public static function getPedidos($id_cliente)
    {
        return \App\Models\admin\PedidosModel::where('id_cliente', $id_cliente)->get();
    }

    // Obtener un pedido específico
    public static function getPedido($idPedido)
    {
        return \App\Models\admin\PedidosModel::find($idPedido);
    }

    // Ver detalles de un pedido
    public static function verPedidos($idPedido)
    {
        return \App\Models\admin\DetallePedido::where('id_pedido', $idPedido)->get();
    }
}