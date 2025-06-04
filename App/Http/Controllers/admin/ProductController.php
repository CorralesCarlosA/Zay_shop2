<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Product ;
use App\Models\admin\Category;
use App\Models\admin\Administrator;
use App\Models\admin\Color;
use App\Models\admin\Size;
use App\Models\admin\ProductStatus;
use App\Models\admin\GenderProduct;
use App\Models\admin\ClassProduct;
use App\Models\admin\ImageProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\admin\Brand;
use App\Models\admin\OfferType;
use Illuminate\Support\Facades\Validator;



class ProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de productos
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);
    
        if ($request->has('categoria') && $request->input('categoria')) {
            $query->where('id_categoria', $request->input('categoria'));
        }
    
        if ($request->has('marca') && $request->input('marca')) {
            $query->where('id_marca', $request->input('marca'));
        }
    
        $productos = $query->paginate(15);
        $categorias = Category::all();
        $marcas = Brand::all();
    
        return view('admin.productos.index', compact('productos', 'categorias', 'marcas'));
    }
    /**
     * Formulario para crear nuevo producto
     */
// app/Http/Controllers/admin/ProductController.php

public function create()
{

   $categorias = Category::whereNotNull('nombre_categoria')->get();
    $clases = ClassProduct::all();
    $generos = GenderProduct::all();
    $colores = Color::all();
    $estados = ProductStatus::all();
    $tiposOferta = OfferType::all();
    $marcas = Brand::all();
    $tallas = Size::all();
    $tiposOferta = OfferType::all();
        $admins = Administrator::all();

    return view('admin.productos.create', compact(
        'categorias', 'colores', 'tallas', 'estados', 'generos', 'clases', 'marcas', 'tiposOferta', 'admins'
    ));
}

    /**
     * Guardar nuevo producto
     */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nombreProducto' => 'required|string|max:100|unique:productos,nombreProducto',
        'descripcionProducto' => 'nullable|string',
        'precioProducto' => 'required|numeric|min:0.01',
        'tallaProducto' => 'nullable|string|max:10',
        'idClaseProducto' => 'required|int|exists:claseproducto,idClaseProducto',
        'idSexoProducto' => 'required|int|exists:sexoproducto,idSexoProducto',
        'id_categoria' => 'required|int|exists:categorias_productos,id_categoria',
        'idColor' => 'required|int|exists:colorproducto,idColor',
        'idEstadoProducto' => 'required|int|exists:estadoproducto,idEstadoProducto',
        'codigoIdentificador' => 'required|string|max:50|unique:productos,codigoIdentificador',
        'destacado' => 'boolean',
        'idTipoOferta' => 'nullable|int|exists:tipo_oferta,id_tipo_oferta',
        'valor_oferta' => 'nullable|numeric|min:0.01|max:'.$request->input('precioProducto'),
        'fecha_inicio_oferta' => 'nullable|date|after_or_equal:today',
        'fecha_fin_oferta' => 'nullable|date|after:fecha_inicio_oferta',
        'id_administrador_oferta' => 'nullable|int|exists:administradores,id_administrador',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $producto = Product::create([
        'nombreProducto' => $request->input('nombreProducto'),
        'descripcionProducto' => $request->input('descripcionProducto'),
        'precioProducto' => $request->input('precioProducto'),
        'tallaProducto' => $request->input('tallaProducto'),
        'idClaseProducto' => $request->input('idClaseProducto'),
        'idSexoProducto' => $request->input('idSexoProducto'),
        'id_categoria' => $request->input('id_categoria'),
        'idColor' => $request->input('idColor'),
        'idEstadoProducto' => $request->input('idEstadoProducto'),
        'codigoIdentificador' => $request->input('codigoIdentificador'),
        'destacado' => $request->has('destacado') ? 1 : 0,
        'idTipoOferta' => $request->input('idTipoOferta'),
        'valor_oferta' => $request->input('valor_oferta'),
        'fecha_inicio_oferta' => $request->input('fecha_inicio_oferta'),
        'fecha_fin_oferta' => $request->input('fecha_fin_oferta'),
        'id_administrador_oferta' => $request->input('id_administrador_oferta'),
        'id_administrador' => auth('administradores')->id(),
        'fechaIngreso' => now(),
        'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);


if ($request->hasFile('imagenes')) {
    foreach ($request->file('imagenes') as $imagen) {
        $ruta = $imagen->store('productos/' . $producto->idProducto, 'public');
        
        ImageProduct::create([
            'id_producto' => $producto->idProducto,
            'url_imagen' => $ruta
        ]);
    }
}


   return redirect()->route('admin.productos.show', $producto->idProducto)
        ->with('success', 'Producto creado correctamente con imágenes');
}

    /**
     * Ver detalles del producto
     */
 public function show($idProducto)
{
    $idProducto = (int)$idProducto; // Conversión explícita a integer
    $producto = Product::with(['category', 'color', 'size', 'productStatus', 'genderProduct', 'classProduct', 'images'])
                      ->findOrFail($idProducto);
    
    return view('admin.productos.show', compact('producto'));
}

    /**
     * Formulario de edición de producto
     */
    public function edit(int $idProducto)
    {
        $producto = Product::with([
            'category',
            'color',
            'size',
            'productStatus',
            'genderProduct',
            'classProduct',
            'brand' // ✅ Carga la marca si existe
        ])->findOrFail($idProducto);
    
        $categorias = Category::all();
        $colores = Color::all();
        $tallas = Size::all();
        $estados = ProductStatus::all();
        $generos = GenderProduct::all();
        $clases = ClassProduct::all();
        $marcas = Brand::all(); // ✅ Cargar marcas
    
        return view('admin.productos.edit', compact(
            'producto', 'categorias', 'colores', 'tallas', 'estados', 'generos', 'clases', 'marcas'
        ));
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
            'id_categoria' => $request->input('id_categoria'),
            'id_marca' => $request->input('id_marca'), 
            'calificacion' => $request->input('calificacion'),
            'comentarios' => $request->input('comentarios')
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

    public function showPublico(int $idProducto)
{
    $producto = Product::with(['images', 'category', 'brand'])->findOrFail($idProducto);
    return view('admin.productos.showPublico', compact('producto'));
}


    
}