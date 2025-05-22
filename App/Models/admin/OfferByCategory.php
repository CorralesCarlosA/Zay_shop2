// app/Models/admin/OfferByCategory.php

<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferByCategory extends Model
{
    use HasFactory;

    protected $table = 'ofertas_por_categoria';
    protected $primaryKey = 'id_oferta_categoria';

    protected $fillable = [
        'id_categoria',
        'idEstadoOferta',
        'idTipoOferta',
        'valor_oferta',
        'fecha_inicio',
        'fecha_fin'
    ];

    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(\App\Models\admin\Category::class, 'id_categoria', 'id_categoria');
    }

    // Relación con estado de oferta
    public function offerStatus()
    {
        return $this->belongsTo(\App\Models\admin\OfferStatus::class, 'idEstadoOferta', 'idEstadoOferta');
    }

    // Relación con tipo de oferta
    public function offerType()
    {
        return $this->belongsTo(\App\Models\admin\OfferType::class, 'idTipoOferta', 'idTipoOferta');
    }
}
