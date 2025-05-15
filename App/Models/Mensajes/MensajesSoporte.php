<?php



namespace App\Models\Mensajes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client\User;

class MensajesSoporte extends Model
{
    use HasFactory;

    protected $table = 'mensajes_soporte';
    protected $primaryKey = 'id_mensaje';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'n_identificacion_cliente',
        'id_administrador',
        'asunto',
        'mensaje',
        'fecha_envio',
        'estado_mensaje',
    ];

    // Relación con el administrador
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'id_administrador', 'id_administrador');
    }

    // Relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'n_identificacion_cliente', 'n_identificacion');
    }
}