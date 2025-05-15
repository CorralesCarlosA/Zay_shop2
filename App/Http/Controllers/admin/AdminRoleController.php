<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdminRoleController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los roles de administrador
     */
    public function index()
    {
        $roles = AdminRole::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Mostrar formulario para nuevo rol
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Guardar nuevo rol
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_rol' => 'required|string|max:50|unique:roles_administradores,nombre_rol'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only(['nombre_rol']);

        $role = new AdminRole($validated);
        $role->save();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol de administrador creado correctamente');
    }

    /**
     * Mostrar detalles de un rol
     */
    public function show(int $id_rol_admin)
    {
        $role = AdminRole::findOrFail($id_rol_admin);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_rol_admin)
    {
        $role = AdminRole::findOrFail($id_rol_admin);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Actualizar rol de administrador
     */
    public function update(Request $request, int $id_rol_admin)
    {
        $role = AdminRole::findOrFail($id_rol_admin);

        $validator = Validator::make($request->all(), [
            'nombre_rol' => 'required|string|max:50|unique:roles_administradores,nombre_rol,' . $id_rol_admin . ',id_rol_admin'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role->fill([
            'nombre_rol' => $request->input('nombre_rol')
        ])->save();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Eliminar rol de administrador
     */
    public function destroy(int $id_rol_admin)
    {
        $role = AdminRole::findOrFail($id_rol_admin);
        $role->delete();

        return back()->with('success', 'Rol eliminado correctamente');
    }
}
