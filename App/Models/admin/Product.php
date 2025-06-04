<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\FavoriteClient as Favorite;
use App\Models\admin\ImageProduct;
use Illuminate\Database\Eloquent\Builder;

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
        'fecha_fin_oferta',
        'destacado',
        'id_marca'
    ];


    public function colors()
    {
        return $this->belongsToMany(
            \App\Models\admin\Size::class,
            'tallas_producto',
            'idProducto',
            'id_talla'
        );
    }
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('idEstadoProducto', 1); // Asumiendo que 1 es el estado "activo"
    }
    public function scopePending(Builder $query): Builder
{
    return $query->where('idEstadoProducto', 2); // Asumiendo que 2 es "pendiente"
}

public function scopeRecent(Builder $query, $days = 30): Builder
{
    return $query->where('fechaIngreso', '>=', now()->subDays($days));
}

    /**
     * Scope para productos sin stock
     */
    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->whereHas('inventory', function($q) {
            $q->where('stock_actual', '<=', 0);
        });
    }


public function sizes()
{
    return $this->hasMany(Size::class, 'nombre_talla', 'tallaProducto');
}
    public function inventory()
    {
        return $this->hasOne(\App\Models\admin\Inventory::class, 'idProducto', 'idProducto');
    }

    public function inventario(){
        return $this->hasOne(\App\Models\admin\Inventory::class, 'idProducto', 'idProducto');
    }

    // Relación con categoría
  
    public function category()
    {
        return $this->belongsTo(\App\Models\admin\Category::class, 'id_categoria', 'id_categoria');
    }

    // Relación con color
public function color()
{
    return $this->belongsTo(Color::class, 'idColor', 'idColor');
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
    public function gender()
    {
        return $this->belongsTo(\App\Models\admin\GenderProduct::class, 'idSexoProducto', 'idSexoProducto');
    }

    // Relación con imágenes
    public function images()
    {
        return $this->hasMany(ImageProduct::class, 'id_producto', 'idProducto');
    }
    
    

    // Relación con carrito
    public function cartItems()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'idProducto', 'idProducto');
    }
  

    // Relación con favoritos
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'idProducto', 'idProducto');
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

public function mainImage()
{
    return $this->hasOne(ImageProduct::class, 'id_producto', 'idProducto')
    ->oldest('orden'); // o ->orderBy('orden', 'asc')ómo guardes las imágenes
}

    public function offerType()
    {
        return $this->belongsTo(\App\Models\admin\OfferType::class, 'idTipoOferta', 'idTipoOferta');
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\admin\ProductStatus::class, 'idEstadoProducto', 'idEstadoProducto');
    }
    public function brand()
    {
        return $this->belongsTo(\App\Models\admin\Brand::class, 'id_marca', 'id_marca');
    }

    // Método auxiliar para verificar si se puede eliminar
    public function canBeDeleted(): bool
    {
        return $this->orders()->exists() === false &&
               $this->cartItems()->exists() === false &&
               $this->reviews()->exists() === false &&
               $this->favorites()->exists() === false;
    }

    public function offerStatus()
{
    return $this->belongsTo(OfferStatus::class, 'idEstadoOferta', 'idEstadoOferta');
}

}