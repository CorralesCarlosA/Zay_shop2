<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'colorproducto';
    protected $primaryKey = 'idColor';

    protected $fillable = ['nombreColor'];

    // Relaciones
    public function cartItems()
    {
        return $this->hasMany(\App\Models\admin\CartItem::class, 'id_color', 'idColor');
    }

    public function orderDetails()
    {
        return $this->hasMany(\App\Models\admin\OrderDetail::class, 'id_color', 'idColor');
    }

    public function saleDetails()
    {
        return $this->hasMany(\App\Models\admin\SaleDetail::class, 'id_color', 'idColor');
    }

    public function returns()
    {
        return $this->hasMany(\App\Models\admin\ReturnProduct::class, 'id_color', 'idColor');
    }
}
