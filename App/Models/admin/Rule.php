<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'reglas_cliente';
    protected $primaryKey = 'id_regla';
    public $timestamps = false;

    protected $fillable = [
        'nombre_regla',
        'descripcion',
        'tipo_cliente',
        'accesible',
        'modulo',
    ];

    // Relación con clientes
    public function clients()
    {
        return $this->hasMany(\App\Models\admin\Client::class, 'id_regla', 'id_regla');
    }
}
