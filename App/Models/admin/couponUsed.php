<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsed extends Model
{
    use HasFactory;

    protected $table = 'cupones_usados';
    protected $primaryKey = 'id_cupon_usado';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_cupon',
        'n_identificacion_cliente',
        'fecha_uso'
    ];

    public function coupon()
    {
        return $this->belongsTo(\App\Models\admin\Coupon::class, 'id_cupon', 'id_cupon');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}
