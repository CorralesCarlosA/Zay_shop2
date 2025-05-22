// app/Models/admin/Coupon.php

<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'cupones_descuento';
    protected $primaryKey = 'id_cupon';

    protected $fillable = [
        'codigo_cupon',
        'tipo_descuento',
        'valor_comprado',
        'valor',
        'fecha_expiracion',
        'activo',
        'cantidad_prudcutos_minimos',
        'max_usos_por_cliente'
    ];

    // Relación con clientes que usaron este cupón
    public function users()
    {
        return $this->hasMany(\App\Models\client\Client::class, 'n_identificacion', 'n_identificacion_cliente')
            ->using(\App\Models\admin\CouponUsed::class);
    }

    // Relación con tabla cupones_usados
    public function usedBy()
    {
        return $this->hasMany(\App\Models\admin\CouponUsed::class, 'id_cupon', 'id_cupon');
    }
}
