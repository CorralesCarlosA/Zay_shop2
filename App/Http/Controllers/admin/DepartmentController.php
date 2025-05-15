<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los departamentos
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.departamentos.index', compact('departments'));
    }

    /**
     * Mostrar formulario para nuevo departamento
     */
    public function create()
    {
        return view('admin.departamentos.create');
    }

    /**
     * Guardar nuevo departamento
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_departamento' => 'required|string|max:100|unique:departamentos,nombre_departamento'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only(['nombre_departamento']);

        $department = new Department($validated);
        $department->save();

        return redirect()->route('admin.departamentos.index')
            ->with('success', 'Departamento creado correctamente');
    }

    /**
     * Mostrar detalles de un departamento
     */
    public function show(int $id_departamento)
    {
        $department = Department::findOrFail($id_departamento);
        return view('admin.departamentos.show', compact('department'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_departamento)
    {
        $department = Department::findOrFail($id_departamento);
        return view('admin.departamentos.edit', compact('department'));
    }

    /**
     * Actualizar departamento
     */
    public function update(Request $request, int $id_departamento)
    {
        $department = Department::findOrFail($id_departamento);

        $validator = Validator::make($request->all(), [
            'nombre_departamento' => 'required|string|max:100|unique:departamentos,nombre_departamento,' . $id_departamento . ',id_departamento'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $department->fill([
            'nombre_departamento' => $request->input('nombre_departamento')
        ])->save();

        return redirect()->route('admin.departamentos.index')
            ->with('success', 'Departamento actualizado correctamente');
    }

    /**
     * Eliminar departamento
     */
    public function destroy(int $id_departamento)
    {
        $department = Department::findOrFail($id_departamento);
        $department->delete();

        return back()->with('success', 'Departamento eliminado correctamente');
    }
}
