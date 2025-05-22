<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FavoriteClient as Favorite;

class FavoriteController extends Controller
{
    /**
     * Mostrar listado de favoritos (admin)
     */
    public function index()
    {
        $favoritos = Favorite::with(['client', 'product'])->get();
        return view('admin.favoritos.index', compact('favoritos'));
    }

    /**
     * Eliminar favorito desde el admin
     */
    public function destroy(int $id_favorito)
    {
        $favorito = Favorite::findOrFail($id_favorito);
        $favorito->delete();

        return back()->with('success', 'Favorito eliminado correctamente');
    }
}
