<?php
namespace App\Models\admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable
{
    use SoftDeletes;

    
    protected $table = 'clientes';
    protected $primaryKey = 'n_identificacion'; // PK personalizada
   protected $dates = ['deleted_at']; 

       public $timestamps = false;


    // Campos editables (incluyendo todos los que mencionas)
    protected $fillable = [
        'n_identificacion', 
        'dni',
        'nombres',
        'apellidos',
        'sexo',
        'fecha_nacimiento',
        'email',
        'password',
        'telefono',
        'direccion',
        'ciudad',
        'pais',
        'codigo_postal',
        'estado_civil',
        'profesion',
        'ingresos_anuales',
        'estado',
        'ultimo_acceso',
        'ip_registro',
        'foto_perfil',
        'notas_admin'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'estado' => 'boolean',
        'deleted_at' => 'datetime',
          'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relación con ventas (ejemplo)
    public function ventas() {
        return $this->hasMany(Sale::class, 'n_identificacion');
    }  public function getCreatedAtAttribute()
    {
        return $this->attributes['fecha_registro'];
    }
}