<?php

use App\Models\admin\Review;
use Illuminate\Http\Request;

class ReviewController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'idProducto' => 'required|int|exists:productos,idProducto',
            'calificacion' => 'required|int|min:1|max:5',
            'comentarios' => 'required|string'
        ]);

        Review::create([
            'n_identificacion_cliente' => session('client.n_identificacion'),
            'idProducto' => $request->input('idProducto'),
            'calificacion' => $request->input('calificacion'),
            'comentarios' => $request->input('comentarios'),
            'fecha_reseña' => now()
        ]);

        return back()->with('success', 'Gracias por tu reseña');
    }
}
