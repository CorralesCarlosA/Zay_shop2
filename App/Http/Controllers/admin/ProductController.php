// app/Http/Controllers/admin/ProductController.php

<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Color;
use App\Models\admin\Size;
use App\Models\admin\ProductStatus;
use App\Models\admin\GenderProduct;
use App\Models\admin\ClassProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de productos
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'productStatus']);

        if ($request->has('categoria') && $request->input('categoria')) {
            $query->where('id_categoria', $request->input('categoria'));
        }

        if ($request->has('estado') && $request->input('estado')) {
            $query->where('idEstadoProducto', $request->input('estado'));
        }

        $productos = $query->get();
        $categorias = Category::all();
        $estados = ProductStatus::all();

        return view('admin.productos.index', compact('productos', 'categorias', 'estados'));
    }

    /**
     * Formulario para crear nuevo producto
     */
    public function create()
    {
        $categorias = Category::all();
        $colores = Color::all();
        $tallas = Size::all();
        $estados = ProductStatus::all();
        $generos = GenderProduct::all();
        $clases = ClassProduct::all();

        return view('admin.productes.create', compact('categorias', 'colores', 'tallas', 'estados', 'generos', 'clases'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreProducto' => 'required|string|max:100|unique:productos,nombreProducto',
            'descripcionProducto' => 'nullable|string',
            'precioProducto' => 'required|numeric|min:0.01',
            'tallaProducto' => 'nullable|string',
            'idClaseProducto' => 'required|int|exists:claseproducto,idClaseProducto',
            'idSexoProducto' => 'required|int|exists:sexoproducto,idSexoProducto',
            'idColor' => 'required|int|exists:colorproducto,idColor',
            'idEstadoProducto' => 'required|int|exists:estadoproducto,idEstadoProducto',
            'id_categoria' => 'nullable|int|exists:categorias_productos,id_categoria',
            'codigoIdentificador' => 'required|string|unique:productos,codigoIdentificador'
        ]);

        $producto = Product::create([
            'nombreProducto' => $request->input('nombreProducto'),
            'descripcionProducto' => $request->input('descripcionProducto'),
            'precioProducto' => $request->input('precioProducto'),
            'tallaProducto' => $request->input('tallaProducto'),
            'idClaseProducto' => $request->input('idClaseProducto'),
            'idSexoProducto' => $request->input('idSexoProducto'),
            'idColor' => $request->input('idColor'),
            'idEstadoProducto' => $request->input('idEstadoProducto'),
            'codigoIdentificador' => $request->input('codigoIdentificador'),
            'id_categoria' => $request->input('id_categoria'),
            'id_administrador' => session('admin.id_administrador'),
            'fechaIngreso' => now(),
        ]);

        return redirect()->route('admin.productos.edit', $producto->idProducto)->with('success', 'Producto creado correctamente');
    }

    /**
     * Ver detalles del producto
     */
    public function show(int $idProducto)
    {
        $producto = Product::with(['category', 'color', 'size', 'productStatus', 'genderProduct', 'classProduct', 'images'])->findOrFail($idProducto);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Formulario de edición de producto
     */
    public function edit(int $idProducto)
    {
        $producto = Product::with(['category', 'color', 'size', 'productStatus', 'genderProduct', 'classProduct'])->findOrFail($idProducto);

        $categorias = Category::all();
        $colores = Color::all();
        $tallas = Size::all();
        $estados = ProductStatus::all();
        $generos = GenderProduct::all();
        $clases = ClassProduct::all();

        return view('admin.productos.edit', compact('producto', 'categorias', 'colores', 'tallas', 'estados', 'generos', 'clases'));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, int $idProducto)
    {
        $producto = Product::findOrFail($idProducto);

        $request->validate([
            'nombreProducto' => 'required|string|max:100|unique:productos,nombreProducto,' . $idProducto . ',idProducto',
            'descripcionProducto' => 'nullable|string',
            'precioProducto' => 'required|numeric|min:0.01',
            'tallaProducto' => 'nullable|string',
            'idClaseProducto' => 'required|int|exists:claseproducto,idClaseProducto',
            'idSexoProducto' => 'required|int|exists:sexoproducto,idSexoProducto',
            'idColor' => 'required|int|exists:colorproducto,idColor',
            'idEstadoProducto' => 'required|int|exists:estadoproducto,idEstadoProducto',
            'codigoIdentificador' => 'required|string|unique:productos,codigoIdentificador,' . $idProducto . ',idProducto',
            'id_categoria' => 'nullable|int|exists:categorias_productos,id_categoria'
        ]);

        $producto->fill([
            'nombreProducto' => $request->input('nombreProducto'),
            'descripcionProducto' => $request->input('descripcionProducto'),
            'precioProducto' => $request->input('precioProducto'),
            'tallaProducto' => $request->input('tallaProducto'),
            'idClaseProducto' => $request->input('idClaseProducto'),
            'idSexoProducto' => $request->input('idSexoProducto'),
            'idColor' => $request->input('idColor'),
            'idEstadoProducto' => $request->input('idEstadoProducto'),
            'codigoIdentificador' => $request->input('codigoIdentificador'),
            'id_categoria' => $request->input('id_categoria')
        ])->save();

        return back()->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Eliminar producto (si no tiene dependencias)
     */
    public function destroy(int $idProducto)
    {
        $producto = Product::findOrFail($idProducto);

        if (!$producto->canBeDeleted()) {
            return back()->withErrors(['error' => 'No puedes eliminar este producto porque está en uso']);
        }

        $producto->delete();
        return back()->with('success', 'Producto eliminado correctamente');
    }
}
