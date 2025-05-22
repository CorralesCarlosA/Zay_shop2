<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Size;

class SizeController extends Controller
{
    public function index()
    {
        $tallas = Size::all();
        return view('admin.productos.tallas.index', compact('tallas'));
    }

    public function create()
    {
        return view('admin.productos.tallas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreTalla' => 'required|string|max:255',
            'estadoTalla' => 'required|in:0,1'
        ]);

        Size::create($request->only(['nombreTalla', 'estadoTalla']));

        return redirect()->route('admin.productos.talla.index')
            ->with('success', 'Talla creada correctamente');
    }

    public function show(int $id_talla)
    {
        $talla = Size::findOrFail($id_talla);
        return view('admin.productos.tallas.show', compact('talla'));
    }

    public function edit(int $id_talla)
    {
        $talla = Size::findOrFail($id_talla);
        return view('admin.productos.tallas.edit', compact('talla'));
    }

    public function update(Request $request, int $id_talla)
    {
        $request->validate([
            'nombreTalla' => 'required|string|max:255',
            'estadoTalla' => 'required|in:0,1'
        ]);

        $talla = Size::findOrFail($id_talla);
        $talla->update($request->only(['nombreTalla', 'estadoTalla']));

        return redirect()->route('admin.productos.talla.index')
            ->with('success', 'Talla actualizada correctamente');
    }

    public function destroy(int $id_talla)
    {
        $talla = Size::findOrFail($id_talla);
        $talla->delete();

        return back()->with('success', 'Talla eliminada correctamente');
    }
}
