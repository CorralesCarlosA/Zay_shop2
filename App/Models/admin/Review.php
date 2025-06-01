<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reseñas_productos';
    protected $primaryKey = 'id_reseña';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'idProducto',
        'calificacion',
        'comentarios',
        'fecha_reseña'
    ];

    // Relación con cliente
    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    // Relación con producto
    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
    }
}
