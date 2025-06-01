<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $ciudades = City::where('estado', 1)->get();
        return view('client.auth.register', compact('ciudades'));
    }

    public function store(Request $request)
    {
        // Validación corregida
        $validated = $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT', 'Pasaporte (CE)'])],
            'n_identificacion' => 'required|string|max:10|unique:clientesn_identificacion',
            'n_telefono' => 'required|string|max:10|min:7',
            'Direccion_recidencia' => 'required|string|max:255',
            'correoE' => 'required|email|max:150|unique:clientes,correoE',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'estatura_m' => 'nullable|numeric|between:0.5,2.5',
            'password' => 'required|min:8|confirmed',
            'ciudad' => 'required|integer|exists:ciudades,id_ciudad'
        ]);

        // Creación del cliente corregida
        $cliente = Client::create([
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'tipo_identificacion' => $validated['tipo_identificacion'],
            'n_identificacion' => $validated['n_identificacion'],
            'estado_cliente' => 1, // Activo por defecto
            'tipo_cliente' => 'Hierro', // Nivel inicial
            'n_telefono' => $validated['n_telefono'],
            'Direccion_recidencia' => $validated['Direccion_recidencia'],
            'correoE' => $validated['correoE'],
            'sexo' => $validated['sexo'],
            'estatura(m)' => $validated['estatura_m'] ?? null,
            'fecha_registro' => now(),
            'password' => Hash::make($validated['password']),
            'ciudad' => $validated['ciudad'],
            'id_administrador' => null,
            'email_verified_at' => null
        ]);

        // Autenticar al cliente después del registro
        auth()->guard('clientes')->login($cliente);

        return redirect()->route('home.index')
               ->with('success', '¡Registro exitoso! Bienvenido a nuestro sistema.');
    }
}