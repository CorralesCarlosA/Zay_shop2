<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteClient extends Model
{
    use HasFactory;

    protected $table = 'favoritos_clientes';
    protected $primaryKey = 'id_favorito';
    public $timestamps = false;

    protected $fillable = [
        'n_identificacion_cliente',
        'idProducto',
        'fecha_agregado'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\admin\Client::class, 'n_identificacion_cliente', 'n_identificacion');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\admin\Product::class, 'idProducto', 'idProducto');
    }
}
