<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Review;
use Illuminate\Http\Request;

class ReviewController extends \App\Http\Controllers\Controller
{
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

        // Filtrar por estado si es necesario
        if ($request->has('estado')) {
            $query->where('estado_reseña', $request->input('estado'));
        }

        $reseñas = $query->paginate(10); // Agregado paginación
        return view('admin.reseñas.index', compact('reseñas'));
    }

    public function create()
    {
        $clientes = \App\Models\admin\Client::all();
        $productos = \App\Models\admin\Product::all();
        return view('admin.reseñas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_identificacion_cliente' => 'required|string|exists:clientes,n_identificacion',
            'idProducto' => 'required|int|exists:productos,idProducto',
            'calificacion' => 'required|int|min:1|max:5',
            'comentario' => 'nullable|string', // Cambiado a singular
        ]);

        Review::create([
            'n_identificacion_cliente' => $request->input('n_identificacion_cliente'),
            'idProducto' => $request->input('idProducto'),
            'calificacion' => $request->input('calificacion'),
            'comentario' => $request->input('comentario'),
            'fecha_reseña' => now(),
            'estado_reseña' => 'Aprobada' // Las creadas manualmente se aprueban automáticamente
        ]);

        return redirect()->route('admin.reseñas.index')->with('success', 'Reseña creada correctamente');
    }

    public function show(int $id_reseña)
    {
        $reseña = Review::with(['product', 'client'])->findOrFail($id_reseña);
        return view('admin.reseñas.show', compact('reseña'));
    }

    public function edit(int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);
        $clientes = \App\Models\admin\Client::all();
        $productos = \App\Models\admin\Product::all();

        return view('admin.reseñas.edit', compact('reseña', 'clientes', 'productos'));
    }

    public function update(Request $request, int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);

        $request->validate([
            'n_identificacion_cliente' => 'required|string|exists:clientes,n_identificacion',
            'idProducto' => 'required|int|exists:productos,idProducto',
            'calificacion' => 'required|int|min:1|max:5',
            'comentario' => 'nullable|string', // Cambiado a singular
        ]);

        $reseña->update([
            'n_identificacion_cliente' => $request->input('n_identificacion_cliente'),
            'idProducto' => $request->input('idProducto'),
            'calificacion' => $request->input('calificacion'),
            'comentario' => $request->input('comentario')
        ]);

        return back()->with('success', 'Reseña actualizada correctamente');
    }

    public function destroy(int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);
        $reseña->delete();

        return back()->with('success', 'Reseña eliminada correctamente');
    }

    // Nuevos métodos para aprobar/rechazar
    public function approve(int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);
        $reseña->update(['estado_reseña' => 'Aprobada']);
        
        return back()->with('success', 'Reseña aprobada correctamente');
    }

    public function reject(int $id_reseña)
    {
        $reseña = Review::findOrFail($id_reseña);
        $reseña->update(['estado_reseña' => 'Rechazada']);
        
        return back()->with('success', 'Reseña rechazada correctamente');
    }
}