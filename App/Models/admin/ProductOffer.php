<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'idProducto';

    protected $fillable = [
        'idEstadoOferta',
        'idTipoOferta',
        'valor_oferta',
        'fecha_inicio_oferta',
        'fecha_fin_oferta',
        'id_administrador_oferta'
    ];

    // Relación con producto
    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
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

    // Relación con administrador que modificó la oferta
    public function admin()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador_oferta', 'id_administrador');
    }
}
