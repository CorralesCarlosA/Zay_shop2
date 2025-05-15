<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'idProducto';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombreProducto',
        'precioProducto',
        'tallaProducto',
        'idClaseProducto',
        'idSexoProducto',
        'cantidadDisponible',
        'descripcionProducto',
        'codigoIdentificador',
        'idEstadoOferta',
        'idTipoOferta',
        'idColor',
        'idEstadoProducto',
        'id_categoria',
        'fechaIngreso',
        'calificacion',
        'comentarios',
        'id_administrador',
    ];

    // Relación con el administrador
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador', 'id_administrador');
    }
}
