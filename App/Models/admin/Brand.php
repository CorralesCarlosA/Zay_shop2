<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
protected $table = 'marca_producto';
protected $primaryKey = 'id_marca';

protected $fillable = [
'nombre_marca',
'descripcion',
'estado_marca'
];

public function products()
{
return $this->hasMany(Product::class, 'id_marca', 'id_marca');
}
}