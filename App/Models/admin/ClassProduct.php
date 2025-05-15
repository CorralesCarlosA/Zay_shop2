<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassProduct extends Model
{
    use HasFactory;

    protected $table = 'claseproducto';
    protected $primaryKey = 'idClaseProducto';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['clase'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'idClaseProducto', 'idClaseProducto');
    }
}
