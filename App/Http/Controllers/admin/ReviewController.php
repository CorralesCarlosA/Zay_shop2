<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Review;
use Illuminate\Http\Request;

class ReviewController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las reseñas
     */
    public function index(Request $request)
    {
        $query = Review::with(['product', 'client']);

        if ($request->has('cliente') && $request->input('cliente')) {
            $search = $request->input('cliente');
            $query->whereHas('client', fn($q) => $q->where('nombres', 'like', "%$search%"));
        }

        if ($request->has('producto') && $request->input('producto')) {
            $search = $request->input('producto');
            $query->whereHas('product', fn($q) => $q->where('nombreProducto', 'like', "%$search%"));
        }

        if ($request->has('calificacion') && $request->input('calificacion')) {
            $query->where('calificacion', $request->input('calificacion'));
        }

        $reseñas = $query->get();
        return view('admin.reseñas.index', compact('reseñas'));
    }

    /**
     * Formulario para nueva reseña (manual)
     */
    public function create()
    {
        $clientes = \App\Models\client\Client::all();
        $productos = \App\Models\admin\Product::all();
        return view('admin.reseñas.create', compact('clientes', 'productos'));
    }

    /**
     * Guardar nueva reseña manual
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_identificacion_cliente' => 'required|string|exists:clientes,n_identificacion',
            'idProducto' => 'required|int|exists:productos,idProducto',
            'calificacion' => 'required|int|min:1|max:5',
            'comentarios' => 'nullable|string',
        ]);

        Review::create([
            'n_identificacion_cliente' => $request->input('n_identificacion_cliente'),
            'idProducto' => $request->input('idProducto'),
            'calificacion' => $request->input('calificacion'),
            'comentarios' => $request->input('comentarios'),
            'fecha_reseña' => now(),
        ]);

        return redirect()->route('admin.reseñas.index')->with('success', 'Reseña creada correctamente');
    }

    /**
     * Ver detalles de una reseña
     */
    public function show(int $id_reseña)
    {
        $reseña = Review::with(['product', 'client'])->findOrFail($id_reseña);
        return view('admin.reseñas.show', compact('reseña'));
    }

    /**
     * Editar una reseña
     */
    public function edit(int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);
        $clientes = \App\Models\client\Client::all();
        $productos = \App\Models\admin\Product::all();

        return view('admin.reseñas.edit', compact('reseña', 'clientes', 'productos'));
    }

    /**
     * Actualizar reseña
     */
    public function update(Request $request, int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);

        $request->validate([
            'n_identificacion_cliente' => 'required|string|exists:clientes,n_identificacion',
            'idProducto' => 'required|int|exists:productos,idProducto',
            'calificacion' => 'required|int|min:1|max:5',
            'comentarios' => 'nullable|string',
        ]);

        $reseña->fill([
            'n_identificacion_cliente' => $request->input('n_identificacion_cliente'),
            'idProducto' => $request->input('idProducto'),
            'calificacion' => $request->input('calificacion'),
            'comentarios' => $request->input('comentarios')
        ])->save();

        return back()->with('success', 'Reseña actualizada correctamente');
    }

    /**
     * Eliminar reseña
     */
    public function destroy(int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);
        $reseña->delete();

        return back()->with('success', 'Reseña eliminada correctamente');
    }
}
