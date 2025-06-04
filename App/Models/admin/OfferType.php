<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    use HasFactory;

    protected $table = 'tipooferta';
    protected $primaryKey = 'idTipoOferta';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nombreTipo', 'descripcion'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'idTipoOferta', 'idTipoOferta');
    }
}
