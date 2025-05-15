<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\ProductPriceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Product;
use App\Models\admin\Administrator;

class HistorialPreciosController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los registros del historial de precios
     */
    public function index()
    {
        $history = ProductPriceHistory::with(['product', 'administrator'])->get();
        return view('admin.historial-precios.index', compact('history'));
    }

    /**
     * Mostrar formulario para nuevo registro de precio
     */
    public function create()
    {
        $products = Product::all();
        $administrators = Administrator::all();

        return view('admin.historial-precios.create', compact('products', 'administrators'));
    }

    /**
     * Guardar nuevo registro del historial de precios
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idProducto' => 'required|exists:productos,idProducto',
            'precio_anterior' => 'required|numeric|min:0',
            'precio_nuevo' => 'required|numeric|min:0',
            'fecha_cambio' => 'nullable|date',
            'hora_cambio' => 'nullable|date_format:H:i:s',
            'id_administrador' => 'required|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'idProducto',
            'precio_anterior',
            'precio_nuevo',
            'id_administrador'
        ]);

        // Si no se proporciona fecha/hora, usar ahora
        $validated['fecha_cambio'] = $request->input('fecha_cambio') ?: now()->toDateTimeString();
        $validated['hora_cambio'] = $request->input('hora_cambio') ?: now()->format('H:i:s');

        $history = new ProductPriceHistory($validated);
        $history->save();

        return redirect()->route('admin.historial-precios.show', $history->id_historial)
            ->with('success', 'Registro de historial creado correctamente');
    }

    /**
     * Mostrar detalles de un registro de historial
     */
    public function show(int $id_historial)
    {
        $record = ProductPriceHistory::with(['product', 'administrator'])->findOrFail($id_historial);
        return view('admin.historial-precios.show', compact('record'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_historial)
    {
        $record = ProductPriceHistory::with(['product', 'administrator'])->findOrFail($id_historial);
        $products = Product::all();
        $administrators = Administrator::all();

        return view('admin.historial-precios.edit', compact('record', 'products', 'administrators'));
    }

    /**
     * Actualizar registro de historial
     */
    public function update(Request $request, int $id_historial)
    {
        $record = ProductPriceHistory::findOrFail($id_historial);

        $validator = Validator::make($request->all(), [
            'idProducto' => 'required|exists:productos,idProducto',
            'precio_anterior' => 'required|numeric|min:0',
            'precio_nuevo' => 'required|numeric|min:0',
            'fecha_cambio' => 'required|date',
            'hora_cambio' => 'required|date_format:H:i:s',
            'id_administrador' => 'required|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $record->fill([
            'idProducto' => $request->input('idProducto'),
            'precio_anterior' => $request->input('precio_anterior'),
            'precio_nuevo' => $request->input('precio_nuevo'),
            'fecha_cambio' => $request->input('fecha_cambio'),
            'hora_cambio' => $request->input('hora_cambio'),
            'id_administrador' => $request->input('id_administrador')
        ])->save();

        return redirect()->route('admin.historial-precios.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Eliminar registro de historial de precios
     */
    public function destroy(int $id_historial)
    {
        $record = ProductPriceHistory::findOrFail($id_historial);
        $record->delete();

        return back()->with('success', 'Registro eliminado correctamente');
    }
}
