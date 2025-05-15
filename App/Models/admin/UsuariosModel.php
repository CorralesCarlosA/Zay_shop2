<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nombres', 'apellidos', 'correo', 'clave', 'perfil', 'estado'];

    // Obtener usuarios según el estado
    public static function getUsuarios($estado)
    {
        return self::where('estado', $estado)->get(['id', 'nombres', 'apellidos', 'correo', 'perfil']);
    }

    // Registrar un nuevo usuario
    public static function registrar($nombre, $apellido, $correo, $clave)
    {
        return self::create([
            'nombres' => $nombre,
            'apellidos' => $apellido,
            'correo' => $correo,
            'clave' => bcrypt($clave) // Se recomienda encriptar la clave
        ]);
    }

    // Verificar si un correo está registrado
    public static function verificarCorreo($correo)
    {
        return self::where('correo', $correo)->where('estado', 1)->exists();
    }

    // Eliminar (desactivar) un usuario
    public static function eliminar($idUser)
    {
        return self::where('id', $idUser)->update(['estado' => 0]);
    }

    // Obtener usuario por ID
    public static function getUsuario($idUser)
    {
        return self::find($idUser, ['id', 'nombres', 'apellidos', 'correo']);
    }

    // Modificar usuario existente
    public static function modificar($id, $datos)
    {
        return self::where('id', $id)->update($datos);
    }
}
