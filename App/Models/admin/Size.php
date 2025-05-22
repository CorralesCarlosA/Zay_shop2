<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'tallas_producto';
    protected $primaryKey = 'id_talla';

    protected $fillable = ['nombre_talla'];

    public function products()
    {
        return $this->belongsToMany(\App\Models\admin\Product::class, 'tallas_producto', 'id_talla', 'idProducto');
    }
}
