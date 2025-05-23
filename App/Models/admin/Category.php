<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorias_productos';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre_categoria',
        'descripcion'
    ];

    // Relación con productos
    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'id_categoria', 'id_categoria');
    }

    // Relación con ofertas por categoría
    public function offerByCategory()
    {
        return $this->hasOne(\App\Models\admin\OfferByCategory::class, 'id_categoria', 'id_categoria');
    }
}