<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\GenderProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class GenderProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los sexos de productos
     */
    public function index()
    {
        $genders = GenderProduct::all();
        return view('admin.productos.sexo.index', compact('genders'));
    }

    /**
     * Mostrar formulario para crear nuevo sexo de producto
     */
    public function create()
    {
        return view('admin.productos.sexo.create');
    }

    /**
     * Guardar nuevo sexo de producto
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Unisex']), 'unique:sexoproducto,sexo']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        GenderProduct::create([
            'sexo' => $request->input('sexo')
        ]);

        return redirect()->route('admin.productos.sexo.index')
            ->with('success', 'Sexo de producto creado correctamente');
    }

    /**
     * Mostrar detalles de un sexo de producto
     */
    public function show(int $idSexoProducto)
    {
        $gender = GenderProduct::findOrFail($idSexoProducto);
        return view('admin.productos.sexo.show', compact('gender'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idSexoProducto)
    {
        $gender = GenderProduct::findOrFail($idSexoProducto);
        return view('admin.productos.sexo.edit', compact('gender'));
    }

    /**
     * Actualizar sexo de producto
     */
    public function update(Request $request, int $idSexoProducto)
    {
        $gender = GenderProduct::findOrFail($idSexoProducto);

        $validator = Validator::make($request->all(), [
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino', 'Unisex']), 'unique:sexoproducto,sexo,' . $idSexoProducto . ',idSexoProducto']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $gender->fill([
            'sexo' => $request->input('sexo'),
        ])->save();

        return redirect()->route('admin.productos.sexo.index')
            ->with('success', 'Sexo de producto actualizado correctamente');
    }

    /**
     * Eliminar sexo de producto
     */
    public function destroy(int $idSexoProducto)
    {
        $gender = GenderProduct::findOrFail($idSexoProducto);
        $gender->delete();

        return back()->with('success', 'Sexo de producto eliminado correctamente');
    }
}
