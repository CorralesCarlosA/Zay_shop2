<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenderProduct extends Model
{
    use HasFactory;

    protected $table = 'sexoproducto';
    protected $primaryKey = 'idSexoProducto';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['sexo'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'idSexoProducto', 'idSexoProducto');
    }
}
