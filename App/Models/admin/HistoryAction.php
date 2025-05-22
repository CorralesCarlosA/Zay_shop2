<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAction extends Model
{
    use HasFactory;

    protected $table = 'historial_estados_venta';
    protected $primaryKey = 'id_historial_estado_venta';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'estado_venta',
        'fecha_cambio',
        'hora_cambio',
        'id_administrador'
    ];

    public function index()
    {
        $historial = HistoryAction::with(['client'])->get();
        return view('admin.historial-acciones.index', compact('historial'));
    }

    /**
     * Mostrar un registro específico
     */
    public function show(int $id_registro)
    {
        $registro = HistoryAction::findOrFail($id_registro);
        return view('admin.historial-acciones.show', compact('registro'));
    }

    /**
     * Eliminar un registro de historial
     */

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Relación con ventas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /*******  b7c65183-d05a-43ee-83ad-9501afac3959  *******/
    public function sale()
    {
        return $this->belongsTo(\App\Models\admin\Sale::class, 'id_venta', 'id_venta');
    }

    public function administrator()
    {
        return $this->belongsTo(\App\Models\admin\Administrator::class, 'id_administrador', 'id_administrador');
    }
}
