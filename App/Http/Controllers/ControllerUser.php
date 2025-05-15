<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ControllerUser extends Controller
{
    //
    public function index()
    {
        $shop = DB::select('select * usuario');
        var_dump($shop);
        //return view('/');
    }


    public function regi()
    {
        $guardar = DB::insert('insert into usuario(Usuario,Correo,Cedula,Contrasena) values(?,?,?,?)', [$_POST['usuario'], $_POST['gmail'], $_POST['cc'], $_POST['pwd']]);

        if ($guardar) {
            echo "Registrado con exito";
            return view("productos");
        } else {
            echo "Error al Registrarse";
            return view("registrar");
        }
    }

    public function sesi(Request $request)
    {
        $correo = $_POST['gmail'];
        $contrasena = $_POST['pwd'];

        $guardar = DB::select('select * from usuario  where correo = ? and contrasena = ?', [$correo, $contrasena]);

        if ($guardar && $correo == 'admin@gmail.com' && $contrasena == '1234') {
            //echo "usuario admin";
            return view("panel_");
        } else if ($guardar) {
            Session::put('nombre_user_sesion', $guardar[0]->Usuario); // Asumiendo que el nombre del usuario está en la columna 'nombre'
            // echo "usuario normal";
            return view("menu");
        } else {
            // echo "Error al Iniciar Sesion";
            return view("iniciar-sesion");
        }
    }
}
