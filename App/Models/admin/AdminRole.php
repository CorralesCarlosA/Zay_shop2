<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $table = 'roles_administradores';
    protected $primaryKey = 'id_rol_admin';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nombre_rol'];

    public function administrators()
    {
        return $this->hasMany(\App\Models\admin\Administrator::class, 'id_rol_admin', 'id_rol_admin');
    }

    public function hasPermissionTo(string $permission): bool
    {
        $permisos = json_decode($this->permisos, true);
        return is_array($permisos) && in_array($permission, $permisos);
    }
}
