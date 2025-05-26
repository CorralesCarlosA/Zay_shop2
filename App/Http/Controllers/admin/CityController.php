<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CityController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar lista de ciudades
     */
    public function index()
    {
        $cities = City::with('department')->get();
        return view('admin.ciudades.index', compact('cities'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $departments = \App\Models\admin\Department::all();
        return view('admin.ciudades.create', compact('departments'));
    }

    /**
     * Guardar nueva ciudad
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_ciudad' => 'required|string|max:100|unique:ciudades,nombre_ciudad',
            'id_departamento' => 'required|exists:departamentos,id_departamento',
            'estado' => ['required', Rule::in([0, 1])]
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        City::create([
            'nombre_ciudad' => $request->input('nombre_ciudad'),
            'id_departamento' => $request->input('id_departamento'),
            'estado' => $request->input('estado')
        ]);

        return redirect()->route('admin.ciudades.index')
            ->with('success', 'Ciudad creada correctamente');
    }

    /**
     * Mostrar detalles de una ciudad
     */
    public function show(int $id_ciudad)
    {
        $city = City::with(['department'])->findOrFail($id_ciudad);
        return view('admin.ciudades.show', compact('city'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_ciudad)
    {
        $city = City::findOrFail($id_ciudad);
        $departments = \App\Models\admin\Department::all();

        return view('admin.ciudades.edit', compact('city', 'departments'));
    }

    /**
     * Actualizar ciudad
     */
    public function update(Request $request, int $id_ciudad)
    {
        $city = City::findOrFail($id_ciudad);

        $validator = Validator::make($request->all(), [
            'nombre_ciudad' => 'required|string|max:100|unique:ciudades,nombre_ciudad,' . $id_ciudad . ',id_ciudad',
            'id_departamento' => 'required|exists:departamentos,id_departamento',
            'estado' => ['required', Rule::in([0, 1])]
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $city->fill([
            'nombre_ciudad' => $request->input('nombre_ciudad'),
            'id_departamento' => $request->input('id_departamento'),
            'estado' => $request->input('estado')
        ])->save();

        return redirect()->route('admin.ciudades.index')
            ->with('success', 'Ciudad actualizada correctamente');
    }

    /**
     * Eliminar ciudad
     */
    public function destroy(int $id_ciudad)
    {
        $city = City::findOrFail($id_ciudad);

        if ($city->clients->isNotEmpty()) {
            return back()->withErrors(['error' => 'No puedes eliminar esta ciudad porque tiene clientes registrados']);
        }

        $city->delete();

        return back()->with('success', 'Ciudad eliminada correctamente');
    }
}