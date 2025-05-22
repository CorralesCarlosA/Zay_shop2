<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'idProducto';

    protected $fillable = [
        'nombreProducto',
        'descripcionProducto',
        'precioProducto',
        'tallaProducto',
        'idClaseProducto',
        'idSexoProducto',
        'idColor',
        'idEstadoProducto',
        'codigoIdentificador',
        'id_categoria',
        'id_administrador',
        'fechaIngreso',
        'calificacion',
        'comentarios',
        'ultima_modificacion_oferta',
        'id_administrador_oferta',
        'fecha_inicio_oferta',
        'fecha_fin_oferta'
    ];


    public function colors()
    {
        return $this->belongsToMany(\App\Models\admin\Color::class, 'colores_producto', 'idProducto', 'idColor');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'tallas_producto', 'idProducto', 'id_talla');
    }


    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(\App\Models\admin\Category::class, 'id_categoria', 'id_categoria');
    }

    // Relación con color
    public function color()
    {
        return $this->belongsTo(\App\Models\admin\Color::class, 'idColor', 'idColor');
    }

    // Relación con talla
    public function size()
    {
        return $this->belongsTo(\App\Models\admin\Size::class, 'tallaProducto', 'id_talla');
    }

    // Relación con estado del producto
    public function productStatus()
    {
        return $this->belongsTo(\App\Models\admin\ProductStatus::class, 'idEstadoProducto', 'idEstadoProducto');
    }

    // Relación con clase del producto
    public function classProduct()
    {
        return $this->belongsTo(\App\Models\admin\ClassProduct::class, 'idClaseProducto', 'idClaseProducto');
    }

    // Relación con sexo del producto
    public function genderProduct()
    {
        return $this->belongsTo(\App\Models\admin\GenderProduct::class, 'idSexoProducto', 'idSexoProducto');
    }

    // Relación con imágenes
    public function images()
    {
        return $this->hasMany(\App\Models\admin\ImageProduct::class, 'id_producto', 'idProducto');
    }

    // Relación con carrito
    public function cartItems()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'idProducto', 'idProducto');
    }
    public function offerStatus()
    {
        return $this->belongsTo(\App\Models\admin\OfferStatus::class, 'idEstadoOferta', 'idEstadoOferta');
    }

    // Relación con favoritos
    public function favorites()
    {
        return $this->hasMany(\App\Models\admin\Favorite::class, 'idProducto', 'idProducto');
    }

    // Relación con pedidos
    public function orderDetails()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'idProducto', 'idProducto');
    }

    // Relación con reseñas
    public function reviews()
    {
        return $this->hasMany(\App\Models\admin\ProductReview::class, 'idProducto', 'idProducto');
    }

    // Verificar si puede ser eliminado
    public function canBeDeleted(): bool
    {
        return !($this->orderDetails()->exists() ||
            $this->cartItems()->exists() ||
            $this->favorites()->exists());
    }

    public function offerType()
    {
        return $this->belongsTo(\App\Models\admin\OfferType::class, 'idTipoOferta', 'idTipoOferta');
    }

    public function offerStatus()
    {
        return $this->belongsTo(\App\Models\admin\OfferStatus::class, 'idEstadoOferta', 'idEstadoOferta');
    }
}
