<?php

// app/Models\admin\Session.php → o donde esté

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];

    // Relación con cliente (opcional)
    public function client()
    {
        return $this->belongsTo(\App\Models\client\Client::class, 'user_id', 'n_identificacion');
    }
}
