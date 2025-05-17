<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'tallas_producto';
    protected $primaryKey = 'id_talla';

    protected $fillable = ['nombre_talla', 'descripcion'];

    // Relaciones
    public function cartItems()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'id_talla', 'id_talla');
    }

    public function orderDetails()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_talla', 'id_talla');
    }

    public function saleDetails()
    {
        return $this->hasMany(\App\Models\admin\SaleDetail::class, 'id_talla', 'id_talla');
    }

    public function returns()
    {
        return $this->hasMany(\App\Models\admin\ReturnProduct::class, 'id_talla', 'id_talla');
    }
}
