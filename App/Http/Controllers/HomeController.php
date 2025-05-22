<?php

namespace App\Http\Controllers;

use App\Models\admin\Product;
use Illuminate\Http\Request;

class HomeController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $categorias = \App\Models\admin\Category::all();
        $colores = \App\Models\admin\Color::all();
        $tallas = \App\Models\admin\Size::all();
        $sexos = \App\Models\admin\GenderProduct::all();
        $clases = \App\Models\admin\ClassProduct::all();
        $ofertas = \App\Models\admin\OfferStatus::all();

        // Productos destacados
        $destacados = Product::where('destacado', 1)->take(4)->get();

        // Más vendidos
        $masVendidos = Product::withCount(['orderDetails'])->orderByDesc('ventas_count')->take(4)->get();

        return view('welcome', compact(
            'categorias',
            'colores',
            'tallas',
            'sexos',
            'clases',
            'ofertas',
            'destacados',
            'masVendidos'
        ));
    }
}
