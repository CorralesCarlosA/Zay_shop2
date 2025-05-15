<?php

namespace App\Http\Controllers\admin;

use App\Models\client\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar una lista de clientes
     */
    public function index()
    {
        $clients = Client::with(['city', 'administrator'])->get();
        return view('admin.clientes.index', compact('clients'));
    }

    /**
     * Mostrar formulario para crear un nuevo cliente
     */
    public function create()
    {
        $roles = [];
        $cities = \App\Models\admin\City::all(); // Si necesitas ciudades
        $administrators = \App\Models\admin\Administrator::all(); // Opcional para id_administrador
        return view('admin.clientes.create', compact('cities', 'administrators'));
    }

    /**
     * Guardar un nuevo cliente
     */
    public function store(Request $request)
    {
        // Validación manual por complejidad
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT'])],
            'n_identificacion' => 'required|unique:clientes,n_identificacion|string|max:10',
            'correoE' => 'required|email|unique:clientes,correoE|max:150',
            'tipo_cliente' => ['required', Rule::in(['Oro', 'Plata', 'Bronce', 'Hierro'])],
            'n_telefono' => 'required|string|max:10',
            'Direccion_recidencia' => 'required|string|max:255',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'estatura_m' => 'nullable|numeric|min:0|max:3',
            'password' => 'required|string|min:8|confirmed',
            'ciudad' => 'required|exists:ciudades,id_ciudad',
            'id_administrador' => 'nullable|exists:administradores,id_administrador',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'nombres',
            'apellidos',
            'tipo_identificacion',
            'n_identificacion',
            'correoE',
            'tipo_cliente',
            'n_telefono',
            'Direccion_recidencia',
            'sexo',
            'estatura_m',
            'password',
            'ciudad',
            'id_administrador'
        ]);

        // Encriptar contraseña
        $validated['password'] = Hash::make($validated['password']);

        // Asignar estado_cliente como activo por defecto
        $validated['estado_cliente'] = 1;

        // Asignar fecha_registro (usamos current_timestamp desde BD)
        $validated['fecha_registro'] = now();

        // Crear cliente usando el modelo Eloquent
        $client = new Client($validated);
        $client->save();

        return redirect()->route('admin.clientes.show', $client->n_identificacion)
            ->with('success', 'Cliente creado correctamente');
    }

    /**
     * Mostrar detalles de un cliente
     */
    public function show(string $n_identificacion)
    {
        $client = Client::with(['city', 'administrator'])->findOrFail($n_identificacion);
        return view('admin.clientes.show', compact('client'));
    }

    /**
     * Mostrar formulario para editar un cliente
     */
    public function edit(string $n_identificacion)
    {
        $client = Client::with(['city', 'administrator'])->findOrFail($n_identificacion);
        $cities = \App\Models\admin\City::all();
        $administrators = \App\Models\admin\Administrator::all();
        return view('admin.clientes.edit', compact('client', 'cities', 'administrators'));
    }

    /**
     * Actualizar datos de un cliente
     */
    public function update(Request $request, string $n_identificacion)
    {
        $client = Client::findOrFail($n_identificacion);

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'tipo_identificacion' => ['required', Rule::in(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)', 'NIT'])],
            'n_identificacion' => 'required|string|max:10',
            'correoE' => 'required|email|max:150|unique:clientes,correoE,' . $n_identificacion . ',n_identificacion',
            'tipo_cliente' => ['required', Rule::in(['Oro', 'Plata', 'Bronce', 'Hierro'])],
            'n_telefono' => 'required|string|max:10',
            'Direccion_recidencia' => 'required|string|max:255',
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
            'estatura_m' => 'nullable|numeric|min:0|max:3',
            'ciudad' => 'required|exists:ciudades,id_ciudad',
            'id_administrador' => 'nullable|exists:administradores,id_administrador',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'nombres',
            'apellidos',
            'tipo_identificacion',
            'correoE',
            'tipo_cliente',
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

        $client->fill($data)->save();

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Eliminar un cliente
     */
    public function destroy(string $n_identificacion)
    {
        $client = Client::findOrFail($n_identificacion);
        $client->delete();

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
