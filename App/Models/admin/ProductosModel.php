<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model
{
    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'cantidad', 'imagen', 'id_categoria', 'estado'];

    // Obtener productos según el estado
    public static function getProductos($estado)
    {
        return self::where('estado', $estado)->get();
    }

    // Obtener todas las categorías activas
    public static function getCategorias()
    {
        return \App\Models\admin\CategoriasModel::where('estado', 1)->get();
    }

    // Registrar un nuevo producto
    public static function registrar($datos)
    {
        return self::create($datos);
    }

    // Eliminar (desactivar) un producto
    public static function eliminar($idPro)
    {
        return self::where('id', $idPro)->update(['estado' => 0]);
    }

    // Obtener un producto por ID
    public static function getProducto($idPro)
    {
        return self::find($idPro);
    }

    // Modificar un producto existente
    public static function modificar($id, $datos)
    {
        return self::where('id', $id)->update($datos);
    }

    // Definir la relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(CategoriasModel::class, 'id_categoria');
    }
}
