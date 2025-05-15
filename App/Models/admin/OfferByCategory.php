<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferByCategory extends Model
{
    use HasFactory;

    protected $table = 'ofertas_por_categoria';
    protected $primaryKey = 'id_oferta_categoria';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
        'idEstadoOferta',
        'idTipoOferta',
        'prioridad',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\admin\Category::class, 'id_categoria', 'id_categoria');
    }

    public function offerStatus()
    {
        return $this->belongsTo(\App\Models\admin\OfferStatus::class, 'idEstadoOferta', 'idEstadoOferta');
    }

    public function offerType()
    {
        return $this->belongsTo(\App\Models\admin\OfferType::class, 'idTipoOferta', 'idTipoOferta');
    }
}
