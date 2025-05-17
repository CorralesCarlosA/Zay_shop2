<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'idProducto';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombreProducto',
        'precioProducto',
        'tallaProducto',
        'idClaseProducto',
        'idSexoProducto',
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
        'ultima_modificacion_oferta',
        'id_administrador_oferta',
        'valor_oferta',
        'fecha_inicio_oferta',
        'fecha_fin_oferta'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\admin\Category::class, 'id_categoria', 'id_categoria');
    }

    public function sizes()
    {
        return $this->hasMany(\App\Models\admin\ProductSize::class, 'idProducto', 'idProducto');
    }

    public function productClass()
    {
        return $this->belongsTo(\App\Models\admin\ClassProduct::class, 'idClaseProducto', 'idClaseProducto');
    }

    public function gender()
    {
        return $this->belongsTo(\App\Models\admin\GenderProduct::class, 'idSexoProducto', 'idSexoProducto');
    }




    public function status()
    {
        return $this->belongsTo(\App\Models\admin\ProductStatus::class, 'idEstadoProducto', 'idEstadoProducto');
    }

    // app/Models\admin\Product.php
    public function color()
    {
        return $this->belongsTo(\App\Models\admin\ProductColor::class, 'idColor', 'idColor');
    }

    public function offerStatus()
    {
        return $this->belongsTo(\App\Models\admin\OfferStatus::class, 'idEstadoOferta', 'idEstadoOferta');
    }

    public function offerType()
    {
        return $this->belongsTo(\App\Models\admin\OfferType::class, 'idTipoOferta', 'idTipoOferta');
    }




    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }

    public function inventory()
    {
        return $this->hasOne(\App\Models\admin\Inventory::class, 'idProducto', 'idProducto');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\admin\ImageProduct::class, 'idProducto', 'idProducto');
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\admin\ProductReview::class, 'idProducto', 'idProducto');
    }
}
