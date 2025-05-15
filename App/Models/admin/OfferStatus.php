<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferStatus extends Model
{
    use HasFactory;

    protected $table = 'estadooferta';
    protected $primaryKey = 'idEstadoOferta';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['estado'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'idEstadoOferta', 'idEstadoOferta');
    }
}
