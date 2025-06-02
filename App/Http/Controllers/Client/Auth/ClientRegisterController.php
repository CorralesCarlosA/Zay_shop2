<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ClientRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $ciudades = City::where('estado', 1)->get();
        return view('client.auth.register', compact('ciudades'));
    }

    public function store(Request $request)
    {
        //return response()->json($request);
try {
    // Intentar validar los datos con mensajes personalizados
    $validated = $request->validate([
        'nombres' => 'required|string|max:50',
        'apellidos' => 'required|string|max:50',
        'tipo_identificacion' => ['required', Rule::in([
            'Cedula de ciudadania (CC)',
            'Tarjeta de identidad (TI)',
            'NIT',
            'Pasaporte (CE)'
        ])],
        'n_identificacion' => 'required|string|max:10|unique:clientes,n_identificacion',
        'telefono' => 'required|string|max:10|min:7',
        'Direccion_recidencia' => 'required|string|max:255',
        'correoE' => 'required|email|max:150|unique:clientes,correoE',
        'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
        'estatura_m' => 'nullable|numeric|between:0.5,2.5',
        'password' => 'required|min:8|confirmed',
        'ciudad' => 'required|integer|exists:ciudades,id_ciudad'
    ], [
        'nombres.required' => 'El campo nombres es obligatorio.',
        'apellidos.required' => 'El campo apellidos es obligatorio.',
        'tipo_identificacion.required' => 'Debe seleccionar un tipo de identificación.',
        'n_identificacion.required' => 'El número de identificación es obligatorio.',
        'n_identificacion.unique' => 'Este número de identificación ya está registrado.',
        'telefono.required' => 'El campo teléfono es obligatorio.',
        'Direccion_recidencia.required' => 'Debe ingresar su dirección de residencia.',
        'correoE.required' => 'El campo correo electrónico es obligatorio.',
        'correoE.email' => 'Debe ingresar un correo electrónico válido.',
        'correoE.unique' => 'Este correo ya está registrado.',
        'sexo.required' => 'Debe seleccionar un género.',
        'estatura_m.numeric' => 'La estatura debe ser un número válido.',
        'password.required' => 'Debe ingresar una contraseña.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'ciudad.required' => 'Debe seleccionar una ciudad válida.',
        'ciudad.exists' => 'La ciudad seleccionada no es válida.'
    ]);
} catch (ValidationException $e) {
    // Capturar errores de validación y devolver respuesta JSON con mensajes en español
    return response()->json([
        'status'  => 'error',
        'message' => 'Error en la validación de los datos.',
        'errors'  => $e->errors()
    ], 422);
}

        // Creación del cliente
        $cliente = Client::create([
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'tipo_identificacion' => $validated['tipo_identificacion'],
            'n_identificacion' => $validated['n_identificacion'],
            'estado_cliente' => 1, // Activo por defecto
            'tipo_cliente' => 'Hierro', // Nivel inicial
            'n_telefono' => $validated['telefono'],
            'Direccion_recidencia' => $validated['Direccion_recidencia'],
            'correoE' => $validated['correoE'],
            'sexo' => $validated['sexo'],
            'estatura_m' => $validated['estatura_m'] ?? null,
            'fecha_registro' => now(),
            'password' => Hash::make($validated['password']),
            'ciudad' => $validated['ciudad'],
            'id_administrador' => null,
            'email_verified_at' => null
        ]);

        // Autenticar al cliente después del registro
        //auth()->guard('clientes')->login($cliente);

        // Retornar mensaje con los datos recibidos
        return response()->json([
            'status' => 'success',
            'message' => '¡Registro exitoso! Bienvenido a nuestro sistema.',
            'data' => $validated // Envía los datos recibidos al cliente
        ]);
    }




/*
        try {
        // Intentar validar los datos
        $validated = $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT', 'Pasaporte (CE)'])],
            'n_identificacion' => 'required|string|max:10|unique:clientes,n_identificacion',
            'telefono' => 'required|string|max:10|min:7',
            'Direccion_recidencia' => 'required|string|max:255',
            'correoE' => 'required|email|max:150|unique:clientes,correoE',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'estatura_m' => 'nullable|numeric|between:0.5,2.5',
            'password' => 'required|min:8|confirmed',
            'ciudad' => 'required|integer|exists:ciudades,id_ciudad'
        ]);


    } catch (ValidationException $e) {
        // Capturar errores de validación y devolver respuesta JSON
        return response()->json([
            'status'  => 'error',
            'message' => 'Error en la validación de los datos.',
            'errors'  => $e->errors()
        ], 422);
    }

        $validated = $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT', 'Pasaporte (CE)'])],
            'n_identificacion' => 'required|string|max:10|unique:clientes,n_identificacion',
            'telefono' => 'required|string|max:10|min:7',
            'Direccion_recidencia' => 'required|string|max:255',
            'correoE' => 'required|email|max:150|unique:clientes,correoE',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'estatura_m' => 'nullable|numeric|between:0.5,2.5',
            'password' => 'required|min:8|confirmed',
            'ciudad' => 'required|integer|exists:ciudades,id_ciudad'
        ]);
        return response()->json($validated);


    public function store(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => '¡Registro exitoso! Bienvenido a nuestro sistema.'
        ]);
        // Validación corregida
        $validated = $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT', 'Pasaporte (CE)'])],
            'n_identificacion' => 'required|string|max:10|unique:clientes,n_identificacion',
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
    }*/
}