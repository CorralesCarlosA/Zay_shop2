<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\admin\AdminRole;

class AdministratorController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los administradores
     */
    public function index()
    {
        $administradores = Administrator::with('role')->get();
        return view('admin.administradores.index', compact('administradores'));
    }

    /**
     * Mostrar formulario para crear un nuevo administrador
     */
    public function create()
    {
        $roles = AdminRole::all();
        return view('admin.administradores.create', compact('roles'));
    }

    /**
     * Guardar un nuevo administrador
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'correoE' => 'required|email|unique:administradores,correoE',
            'password' => 'required|string|min:8|confirmed',
            'estado_administrador' => 'required|in:1,0',
            'id_rol_admin' => 'required|exists:roles_administradores,id_rol_admin',
            'n_identificacion' => 'required|string|max:10|unique:administradores,n_identificacion'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'nombres',
            'apellidos',
            'correoE',
            'password',
            'estado_administrador',
            'id_rol_admin',
            'n_identificacion'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['fecha_registro'] = now();

        $administrator = new Administrator($validated);
        $administrator->save();

        return redirect()->route('admin.administradores.show', $administrator->id_administrador)
            ->with('success', 'Administrador creado correctamente');
    }

    /**
     * Mostrar detalles de un administrador
     */
    public function show(int $id_administrador)
    {
        $administrator = Administrator::with(['role'])->findOrFail($id_administrador);
        return view('admin.administradores.show', compact('administrator'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_administrador)
    {
        $administrator = Administrator::with('role')->findOrFail($id_administrador);
        $roles = AdminRole::all();
        return view('admin.administradores.edit', compact('administrator', 'roles'));
    }

    /**
     * Actualizar datos de un administrador
     */
    public function update(Request $request, int $id_administrador)
    {
        $administrator = Administrator::findOrFail($id_administrador);

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'correoE' => 'required|email|unique:administradores,correoE,' . $id_administrador . ',id_administrador',
            'password' => 'nullable|string|min:8|confirmed',
            'estado_administrador' => 'required|in:1,0',
            'id_rol_admin' => 'required|exists:roles_administradores,id_rol_admin',
            'n_identificacion' => 'required|string|max:10|unique:administradores,n_identificacion,' . $id_administrador . ',id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'nombres',
            'apellidos',
            'correoE',
            'estado_administrador',
            'id_rol_admin',
            'n_identificacion'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $administrator->fill($data)->save();

        return redirect()->route('admin.administradores.index')
            ->with('success', 'Administrador actualizado exitosamente');
    }

    /**
     * Eliminar un administrador (si aplica)
     */
    public function destroy(int $id_administrador)
    {
        $administrator = Administrator::findOrFail($id_administrador);
        $administrator->delete();

        return back()->with('success', 'Administrador eliminado correctamente');
    }
}
