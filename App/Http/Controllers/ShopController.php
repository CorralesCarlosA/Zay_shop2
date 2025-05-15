<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function index() {
        $shop = DB::select('select * from zay_shop');
        var_dump($shop);
        //return view('/');
    }

    
public function regi(){
    $guardar = DB::insert('insert into usuario(Usuario,Correo,Cedula,Contrasena) values(?,?,?,?)',[$_POST['nombre'],$_POST['email'],$_POST['password'],$_POST['telefono'],$_POST['direccion']]);
    
    if ($guardar){
        echo "Registrado con exito";
        return view("index");
    }
    else{
        echo "Error al Registrarse";
        return view("registrar");
    }
}

public function sesi(){
    $guardar = DB::select('select * from usuario  where correo = ? and contrasena = ?',[$_POST['gmail'],$_POST['pwd']]);
    if($guardar){
        return view("index");
    }
    else{
        echo "usuario no existe";
        return view("iniciar-sesion");
    }

}

}