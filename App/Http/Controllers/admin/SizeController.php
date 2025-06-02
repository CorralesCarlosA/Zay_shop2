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
        return view('admin.productos.sizes.index', compact('tallas'));
    }

    public function create()
    {
        return view('admin.productos.tallas.create');
    }

 public function store(Request $request)
    {
        $request->validate([
            'nombre_talla' => 'required|string|max:20',
            'descripcion' => 'nullable|string'
        ]);

        Size::create($request->all());

        return back()->with('success', 'Talla creada correctamente');
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

  public function update(Request $request, $id_talla)
    {
        $request->validate([
            'nombre_talla' => 'required|string|max:20',
            'descripcion' => 'nullable|string'
        ]);

        $talla = Size::findOrFail($id_talla);
        $talla->update($request->all());

        return back()->with('success', 'Talla actualizada correctamente');
    }
     public function destroy($id_talla)
    {
        $talla = Size::findOrFail($id_talla);
        $talla->delete();

        return back()->with('success', 'Talla eliminada correctamente');
    }
}
