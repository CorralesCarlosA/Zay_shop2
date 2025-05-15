<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Category;
use App\Models\admin\ClassProduct;
use App\Models\admin\Color;
use App\Models\admin\GenderProduct;
use App\Models\admin\ProductStatus;
use App\Models\admin\OfferStatus;
use App\Models\admin\OfferType;
use App\Models\admin\Administrator;

class ProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los productos con relaciones
     */
    public function index()
    {
        $products = Product::with(['category', 'productClass', 'color', 'gender', 'status'])->get();
        return view('admin.productos.index', compact('products'));
    }

    /**
     * Mostrar formulario para crear producto
     */
    public function create()
    {
        $categories = Category::all();
        $classes = ClassProduct::all();
        $colors = Color::all();
        $genders = GenderProduct::all();
        $statuses = ProductStatus::all();
        $offerStatuses = OfferStatus::all();
        $offerTypes = OfferType::all();
        $administrators = Administrator::all();

        return view('admin.productos.create', compact(
            'categories',
            'classes',
            'colors',
            'genders',
            'statuses',
            'offerStatuses',
            'offerTypes',
            'administrators'
        ));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'nombreProducto' => 'required|string|max:100',
            'precioProducto' => 'required|numeric|min:0',
            'tallaProducto' => 'required|string|max:10',
            'idClaseProducto' => 'required|exists:claseproducto,idClaseProducto',
            'idSexoProducto' => 'required|exists:sexoproducto,idSexoProducto',
            'descripcionProducto' => 'required|string',
            'codigoIdentificador' => 'required|string|max:100|unique:productos,codigoIdentificador',
            'idEstadoOferta' => 'nullable|exists:estadooferta,idEstadoOferta',
            'idTipoOferta' => 'nullable|exists:tipooferta,idTipoOferta',
            'idColor' => 'required|exists:colorproducto,idColor',
            'idEstadoProducto' => 'required|exists:estadoproducto,idEstadoProducto',
            'id_categoria' => 'nullable|exists:categorias_productos,id_categoria',
            'fechaIngreso' => 'nullable|date',
            'calificacion' => 'nullable|numeric|min:0|max:5',
            'comentarios' => 'nullable|string',
            'id_administrador' => 'nullable|exists:administradores,id_administrador',
            'valor_oferta' => 'nullable|numeric|min:0',
            'fecha_inicio_oferta' => 'nullable|date',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->nombreProducto = $request->input('nombreProducto');
        $product->precioProducto = $request->input('precioProducto');
        $product->tallaProducto = $request->input('tallaProducto');
        $product->idClaseProducto = $request->input('idClaseProducto');
        $product->idSexoProducto = $request->input('idSexoProducto');
        $product->descripcionProducto = $request->input('descripcionProducto');
        $product->codigoIdentificador = $request->input('codigoIdentificador');

        // Oferta
        $product->idEstadoOferta = $request->input('idEstadoOferta');
        $product->idTipoOferta = $request->input('idTipoOferta');

        // Estado del producto
        $product->idEstadoProducto = $request->input('idEstadoProducto');

        // Categoría
        $product->id_categoria = $request->input('id_categoria');

        // Fecha de ingreso
        $product->fechaIngreso = $request->input('fechaIngreso') ?: now();

        // Calificación y comentarios
        $product->calificacion = $request->input('calificacion');
        $product->comentarios = $request->input('comentarios');

        // Administrador que lo registró
        $product->id_administrador = $request->input('id_administrador');

        // Oferta
        $product->valor_oferta = $request->input('valor_oferta');
        $product->fecha_inicio_oferta = $request->input('fecha_inicio_oferta');
        $product->fecha_fin_oferta = $request->input('fecha_fin_oferta');

        $product->save();

        return redirect()->route('admin.productos.show', $product->idProducto)
            ->with('success', 'Producto creado correctamente');
    }

    /**
     * Mostrar detalles de un producto
     */
    public function show(int $idProducto)
    {
        $product = Product::with([
            'category',
            'productClass',
            'color',
            'gender',
            'status',
            'administrator'
        ])->findOrFail($idProducto);

        return view('admin.productos.show', compact('product'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $idProducto)
    {
        $product = Product::findOrFail($idProducto);
        $categories = Category::all();
        $classes = ClassProduct::all();
        $colors = Color::all();
        $genders = GenderProduct::all();
        $statuses = ProductStatus::all();
        $offerStatuses = OfferStatus::all();
        $offerTypes = OfferType::all();
        $administrators = Administrator::all();

        return view('admin.productos.edit', compact(
            'product',
            'categories',
            'classes',
            'colors',
            'genders',
            'statuses',
            'offerStatuses',
            'offerTypes',
            'administrators'
        ));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, int $idProducto)
    {
        $product = Product::findOrFail($idProducto);

        $validator = Validator::make($request->all(), [
            'nombreProducto' => 'required|string|max:100',
            'precioProducto' => 'required|numeric|min:0',
            'tallaProducto' => 'required|string|max:10',
            'idClaseProducto' => 'required|exists:claseproducto,idClaseProducto',
            'idSexoProducto' => 'required|exists:sexoproducto,idSexoProducto',
            'descripcionProducto' => 'required|string',
            'codigoIdentificador' => 'required|string|max:100|unique:productos,codigoIdentificador,' . $idProducto . ',idProducto',
            'idEstadoOferta' => 'nullable|exists:estadooferta,idEstadoOferta',
            'idTipoOferta' => 'nullable|exists:tipooferta,idTipoOferta',
            'idColor' => 'required|exists:colorproducto,idColor',
            'idEstadoProducto' => 'required|exists:estadoproducto,idEstadoProducto',
            'id_categoria' => 'nullable|exists:categorias_productos,id_categoria',
            'fechaIngreso' => 'nullable|date',
            'calificacion' => 'nullable|numeric|min:0|max:5',
            'comentarios' => 'nullable|string',
            'id_administrador' => 'nullable|exists:administradores,id_administrador',
            'valor_oferta' => 'nullable|numeric|min:0',
            'fecha_inicio_oferta' => 'nullable|date',
            'fecha_fin_oferta' => 'nullable|date|after_or_equal:fecha_inicio_oferta',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'nombreProducto',
            'precioProducto',
            'tallaProducto',
            'idClaseProducto',
            'idSexoProducto',
            'descripcionProducto',
            'codigoIdentificador',
            'idEstadoOferta',
            'idTipoOferta',
            'idColor',
            'idEstadoProducto',
            'id_categoria',
            'fechaIngreso',
            'calificacion',
            'comentarios',
            'id_administrador',
            'valor_oferta',
            'fecha_inicio_oferta',
            'fecha_fin_oferta'
        ]);

        $product->fill($data)->save();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar producto
     */
    public function destroy(int $idProducto)
    {
        $product = Product::findOrFail($idProducto);
        $product->delete();

        return back()->with('success', 'Producto eliminado correctamente');
    }
}
