<?php

namespace App\Http\Controllers\client;

use App\Models\client\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ClientController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar perfil del cliente autenticado
     */
    public function show(Request $request)
    {
        // Suponiendo que el cliente está logueado y su n_identificacion está en sesión
        $nIdentificacion = $request->session()->get('cliente_id');

        if (!$nIdentificacion) {
            return redirect()->route('client.login')->withErrors(['error' => 'Debe iniciar sesión']);
        }

        $cliente = Client::with('city', 'administrator')->findOrFail($nIdentificacion);
        return view('client.perfil.index', compact('cliente'));
    }

    /**
     * Mostrar formulario para editar perfil
     */
    public function edit(Request $request)
    {
        $nIdentificacion = $request->session()->get('cliente_id');

        if (!$nIdentificacion) {
            return redirect()->route('client.login')->withErrors(['error' => 'Debe iniciar sesión']);
        }

        $cliente = Client::findOrFail($nIdentificacion);
        $cities = \App\Models\admin\City::all();
        $administrators = \App\Models\admin\Administrator::all();

        return view('client.perfil.edit', compact('cliente', 'cities', 'administrators'));
    }

    /**
     * Actualizar datos del cliente
     */
    public function update(Request $request)
    {
        $nIdentificacion = $request->session()->get('cliente_id');

        if (!$nIdentificacion) {
            return redirect()->route('client.login')->withErrors(['error' => 'Debe iniciar sesión']);
        }

        $cliente = Client::findOrFail($nIdentificacion);

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT'])],
            'correoE' => 'required|email|max:150|unique:clientes,correoE,' . $nIdentificacion . ',n_identificacion',
            'n_telefono' => 'required|string|max:10',
            'Direccion_recidencia' => 'required|string|max:255',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'estatura_m' => 'nullable|numeric|min:0|max:3',
            'password' => 'nullable|string|min:8|confirmed',
            'ciudad' => 'required|exists:ciudades,id_ciudad',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'nombres',
            'apellidos',
            'tipo_identificacion',
            'correoE',
            'n_telefono',
            'Direccion_recidencia',
            'sexo',
            'estatura_m',
            'ciudad',
            'id_administrador'
        ]);

        // Si hay nueva contraseña, actualízala
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $cliente->fill($data)->save();

        return redirect()->route('client.perfil.show')
            ->with('success', 'Perfil actualizado correctamente');
    }
}
