<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ColorController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los colores de productos
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin.productos.colors.index', compact('colors'));
    }

    /**
     * Mostrar formulario para crear nuevo color
     */
    public function create()
    {
        return view('admin.productos.color.create');
    }

    /**
     * Guardar nuevo color
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreColor' => 'required|string|max:50|unique:colorproducto,nombreColor'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only(['nombreColor']);

        $color = new Color($validated);
        $color->save();

        return redirect()->route('admin.productos.color.index')
            ->with('success', 'Color creado correctamente');
    }

    /**
     * Mostrar detalles de un color
     */
    public function show(int $idColor)
    {
        $color = Color::findOrFail($idColor);
        return view('admin.productos.color.show', compact('color'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idColor)
    {
        $color = Color::findOrFail($idColor);
        return view('admin.productos.color.edit', compact('color'));
    }

    /**
     * Actualizar color
     */
    public function update(Request $request, int $idColor)
    {
        $color = Color::findOrFail($idColor);

        $validator = Validator::make($request->all(), [
            'nombreColor' => 'required|string|max:50|unique:colorproducto,nombreColor,' . $idColor . ',idColor'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $color->fill([
            'nombreColor' => $request->input('nombreColor')
        ])->save();

        return redirect()->route('admin.productos.color.index')
            ->with('success', 'Color actualizado correctamente');
    }

    /**
     * Eliminar color
     */
    public function destroy(int $idColor)
    {
        $color = Color::findOrFail($idColor);
        $color->delete();

        return back()->with('success', 'Color eliminado correctamente');
    }
}
