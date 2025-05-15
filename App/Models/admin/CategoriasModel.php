<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class CategoriasModel extends Model
{
    protected $table = 'categorias'; // Nombre de la tabla en la BD
    protected $fillable = ['categoria', 'estado']; // Columnas que pueden asignarse masivamente

    // Obtener categorías activas/inactivas
    public static function getCategorias($estado)
    {
        return self::where('estado', $estado)->get();
    }

    // Registrar nueva categoría
    public static function registrar($categoria)
    {
        return self::create(['categoria' => $categoria, 'estado' => 1]);
    }

    // Verificar si una categoría existe
    public static function verificarCategoria($categoria)
    {
        return self::where('categoria', $categoria)->where('estado', 1)->first();
    }

    // Eliminar (desactivar) una categoría
    public static function eliminar($idCat)
    {
        return self::where('id', $idCat)->update(['estado' => 0]);
    }

    // Obtener una categoría por ID
    public static function getCategoria($idCat)
    {
        return self::find($idCat);
    }

    // Modificar categoría
    public static function modificar($id, $categoria)
    {
        return self::where('id', $id)->update(['categoria' => $categoria]);
    }
}
