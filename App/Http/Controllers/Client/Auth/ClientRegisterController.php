<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\client\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientRegisterController extends \App\Http\Controllers\Controller
{
    public function showRegistrationForm()
    {
        $ciudades = \App\Models\admin\City::all();
        return view('client.auth.register', compact('ciudades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'correoE' => 'required|email|unique:clientes,correoE',
            'password' => 'required|min:6|confirmed',
            'n_telefono' => 'required|digits:10',
            'sexo' => 'required|in:M,F,Otro',
            'Direccion_recidencia' => 'required',
            'ciudad' => 'required|int|exists:ciudades,id_ciudad'
        ]);

        Client::create([
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'tipo_identificacion' => 'CC',
            'n_identificacion' => uniqid(),
            'correoE' => $request->input('correoE'),
            'password' => Hash::make($request->input('password')),
            'sexo' => $request->input('sexo'),
            'n_telefono' => $request->input('n_telefono'),
            'Direccion_recidencia' => $request->input('Direccion_recidencia'),
            'ciudad' => $request->input('ciudad'),
            'estado_cliente' => 'Activo',
            'tipo_cliente' => 'Regular'
        ]);

        return redirect()->route('client.login')->with('success', 'Registro exitoso. Por favor inicia sesión.');
    }
}
