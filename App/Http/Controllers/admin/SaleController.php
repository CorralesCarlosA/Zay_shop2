<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Sale;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\client\Client;
use App\Models\admin\Administrator;
use App\Models\admin\City;

class SaleController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las ventas
     */
    public function index()
    {
        $ventas = Sale::with(['client', 'shippingCity', 'administrator'])->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Mostrar formulario para nueva venta
     */
    public function create()
    {
        $clientes = Client::all();
        $administradores = Administrator::all();
        $ciudades = City::all();

        return view('admin.ventas.create', compact('clientes', 'administradores', 'ciudades'));
    }

    /**
     * Guardar nueva venta
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'total_venta' => 'required|numeric|min:0',
            'estado_venta' => ['required', Rule::in(['Pendiente', 'Completada', 'Cancelada'])],
            'metodo_pago' => 'required|string|max:50',
            'direccion_envio' => 'required|string|max:255',
            'ciudad_envio' => 'required|exists:ciudades,id_ciudad',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'n_identificacion_cliente',
            'total_venta',
            'estado_venta',
            'metodo_pago',
            'direccion_envio',
            'ciudad_envio',
            'id_administrador'
        ]);

        $venta = new Sale($validated);
        $venta->save();

        return redirect()->route('admin.ventas.show', $venta->id_venta)
            ->with('success', 'Venta creada correctamente');
    }

    /**
     * Mostrar detalles de una venta
     */
    public function show(int $id_venta)
    {
        $venta = Sale::with(['client', 'shippingCity', 'administrator'])->findOrFail($id_venta);
        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_venta)
    {
        $venta = Sale::with(['client', 'shippingCity', 'administrator'])->findOrFail($id_venta);
        $clientes = Client::all();
        $administradores = Administrator::all();
        $ciudades = City::all();

        return view('admin.ventas.edit', compact('venta', 'clientes', 'administradores', 'ciudades'));
    }

    /**
     * Actualizar datos de una venta
     */
    public function update(Request $request, int $id_venta)
    {
        $venta = Sale::findOrFail($id_venta);

        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'total_venta' => 'required|numeric|min:0',
            'estado_venta' => ['required', Rule::in(['Pendiente', 'Completada', 'Cancelada'])],
            'metodo_pago' => 'required|string|max:50',
            'direccion_envio' => 'required|string|max:255',
            'ciudad_envio' => 'required|exists:ciudades,id_ciudad',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'n_identificacion_cliente',
            'total_venta',
            'estado_venta',
            'metodo_pago',
            'direccion_envio',
            'ciudad_envio',
            'id_administrador'
        ]);

        $venta->fill($data)->save();

        return redirect()->route('admin.ventas.index')
            ->with('success', 'Venta actualizada correctamente');
    }

    /**
     * Eliminar una venta (si aplica)
     */
    public function destroy(int $id_venta)
    {
        $venta = Sale::findOrFail($id_venta);
        $venta->delete();

        return back()->with('success', 'Venta eliminada correctamente');
    }
}
