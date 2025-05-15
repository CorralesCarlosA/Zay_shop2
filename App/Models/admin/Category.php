<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorias_productos';
    protected $primaryKey = 'id_categoria';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nombre_categoria'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'id_categoria', 'id_categoria');
    }
}
