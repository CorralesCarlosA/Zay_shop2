<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class visualizadorModelos extends Controller
{
    public function modelClient()
    {
        return view('modelos_vistas.formularios_clientes');
    }

    public function modelAdmin()
    {
        return view('modelos_vistas.formularios_administrador');
    }
}
