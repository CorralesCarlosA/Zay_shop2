<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;

    protected $table = 'estadoproducto';
    protected $primaryKey = 'idEstadoProducto';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['estado'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'idEstadoProducto', 'idEstadoProducto');
    }
}