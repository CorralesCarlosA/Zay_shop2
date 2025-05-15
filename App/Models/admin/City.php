<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nombre_ciudad', 'id_departamento'];

    public function department()
    {
        return $this->belongsTo(\App\Models\admin\Department::class, 'id_departamento', 'id_departamento');
    }

    public function clients()
    {
        return $this->hasMany(\App\Models\client\Client::class, 'ciudad', 'id_ciudad');
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\admin\Order::class, 'ciudad_envio', 'id_ciudad');
    }
}
