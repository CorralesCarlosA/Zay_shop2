<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function index()
    {
        return view('client.productos');
    }
    // ruta para los productos
    public function productos()
    {
        return view('client.productosall');
    }
    // ruta para los perfiles
    public function perfil()
    {
        return view('client.perfil.pages.perfilStart');
    }

    public function mostrar()
    {
        return view('client.mostrar_informacion');
    }

    public function productonly()
    {
        return view('client.productonly');
    }

    public function sesion()
    {
        return view('client.iniciar-sesion');
    }

    public function administrador()
    {
        return view('admin.login');
    }

    //rutas del administrador
    public function usuariosad()
    {
        return view('admin.usuarios.index');
    }
    public function administracion()
    {
        return view('admin.administracion.index');
    }
    public function categorias()
    {
        return view('admin.categorias.index');
    }
    public function pedidos()
    {
        return view('admin.pedidos.index');
    }
    public function productosad()
    {
        return view('admin.productos.index');
    }

    // fin rutas daministrador

    public function listar()
    {
        return view('client.listar');
    }

    public function p_nuevos()
    {
        return view('client.productos_nuevos');
    }

    /*public function productosad()
    {
        return view('client.productosad');
    }*/

    public function menulog()
    {
        return view('client.menu');
    }
}
