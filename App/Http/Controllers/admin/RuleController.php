<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Rule;
use Illuminate\Http\Request;

class RuleController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las reglas del sistema
     */
    public function index()
    {
        $rules = Rule::all();
        return view('admin.reglas.index', compact('rules'));
    }

    /**
     * Mostrar formulario para crear nueva regla
     */
    public function create()
    {
        return view('admin.reglas.create');
    }

    /**
     * Guardar una nueva regla
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_regla' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'tipo_cliente' => ['required', 'in:Oro,Plata,Bronce,Hierro'],
            'modulo' => 'required|string|max:100',
            'accesible' => 'required|boolean',
        ]);

        Rule::create($validated);

        return redirect()->route('admin.reglas.index')->with('success', 'Regla creada correctamente');
    }

    /**
     * Mostrar detalles de una regla
     */
    public function show(int $id_regla)
    {
        $rule = Rule::findOrFail($id_regla);
        return view('admin.reglas.show', compact('rule'));
    }

    /**
     * Mostrar formulario para editar regla
     */
    public function edit(int $id_regla)
    {
        $rule = Rule::findOrFail($id_regla);
        return view('admin.reglas.edit', compact('rule'));
    }

    /**
     * Actualizar regla
     */
    public function update(Request $request, int $id_regla)
    {
        $rule = Rule::findOrFail($id_regla);

        $validated = $request->validate([
            'nombre_regla' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'tipo_cliente' => ['required', 'in:Oro,Plata,Bronce,Hierro'],
            'modulo' => 'required|string|max:100',
            'accesible' => 'required|boolean',
        ]);

        $rule->fill($validated)->save();

        return redirect()->route('admin.reglas.index')->with('success', 'Regla actualizada correctamente');
    }

    /**
     * Eliminar regla
     */
    public function destroy(int $id_regla)
    {
        $rule = Rule::findOrFail($id_regla);
        $rule->delete();

        return back()->with('success', 'Regla eliminada correctamente');
    }
}
