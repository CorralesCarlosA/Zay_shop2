<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
use HasFactory;

protected $table = 'ciudades';
protected $primaryKey = 'id_ciudad';

public $timestamps = false;

protected $fillable = [
'nombre_ciudad',
'id_departamento',
'estado'
];

// Relación con departamento
public function department()
{
return $this->belongsTo(\App\Models\admin\Department::class, 'id_departamento', 'id_departamento');
}

// Relación con clientes
public function clients()
{
return $this->hasMany(\App\Models\admin\Client::class, 'ciudad', 'id_ciudad');
}
}