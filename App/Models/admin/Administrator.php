<?php

namespace App\Models\admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    protected $guard = 'administradores';

    protected $table = 'administradores';
    protected $primaryKey = 'id_administrador';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'correoE',
        'password',
        'estado_administrador'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName()
    {
        return 'correoE'; // Campo usado para login
    }
}