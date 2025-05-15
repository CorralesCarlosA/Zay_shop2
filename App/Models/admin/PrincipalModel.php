<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class PrincipalModel extends Model
{
    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'cantidad', 'id_categoria', 'estado'];

    // Obtener un producto por su ID con su categoría asociada
    public static function getProducto($id_producto)
    {
        return self::with('categoria')->find($id_producto);
    }

    // Búsqueda de productos por nombre o descripción
    public static function getBusqueda($valor)
    {
        return self::where('nombre', 'LIKE', "%$valor%")
            ->orWhere('descripcion', 'LIKE', "%$valor%")
            ->limit(5)
            ->get();
    }

    // Definir la relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(CategoriasModel::class, 'id_categoria');
    }
}
