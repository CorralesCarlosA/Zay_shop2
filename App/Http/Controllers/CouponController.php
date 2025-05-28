<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar listado de cupones
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        if ($request->has('codigo_cupon') && $request->input('codigo_cupon')) {
            $search = $request->input('codigo_cupon');
            $query->where('codigo_cupon', 'like', "%$search%");
        }

        if ($request->has('activo') && $request->input('activo') !== null) {
            $query->where('activo', $request->input('activo'));
        }

        $cupones = $query->get();
        return view('admin.cupones.index', compact('cupones'));
    }

    /**
     * Formulario para nuevo cupón
     */
    public function create()
    {
        return view('admin.cupones.create');
    }

    /**
     * Guardar nuevo cupón
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_cupon' => 'required|string|max:50|unique:cupones_descuento,codigo_cupon',
            'tipo_descuento' => ['required', Rule::in(['Porcentaje', 'Valor fijo'])],
            'valor_comprado' => 'required|int|min:0',
            'valor' => 'required|numeric|min:0.01',
            'fecha_expiracion' => 'required|date|after_or_equal:today',
            'cantidad_prudcutos_minimos' => 'nullable|int|min:1',
            'max_usos_por_cliente' => 'nullable|int|min:1',
        ]);

        Coupon::create([
            'codigo_cupon' => $request->input('codigo_cupon'),
            'tipo_descuento' => $request->input('tipo_descuento'),
            'valor_comprado' => $request->input('valor_comprado'),
            'valor' => $request->input('valor'),
            'fecha_expiracion' => $request->input('fecha_expiracion'),
            'activo' => $request->has('activo') ? 1 : 0,
            'cantidad_prudcutos_minimos' => $request->input('cantidad_prudcutos_minimos', 1),
            'max_usos_por_cliente' => $request->input('max_usos_por_cliente', 1),
        ]);

        return redirect()->route('admin.cupones.index')->with('success', 'Cupón creado correctamente');
    }

    /**
     * Ver detalles del cupón
     */
    public function show(int $id_cupon)
    {
        $cupon = Coupon::findOrFail($id_cupon);
        return view('admin.cupones.show', compact('cupon'));
    }

    /**
     * Formulario de edición
     */
    public function edit(int $id_cupon)
    {
        $cupon = Coupon::findOrFail($id_cupon);
        return view('admin.cupones.edit', compact('cupon'));
    }

    /**
     * Actualizar cupón
     */
    public function update(Request $request, int $id_cupon)
    {
        $cupon = Coupon::findOrFail($id_cupon);

        $request->validate([
            'codigo_cupon' => "required|string|max:50|unique:cupones_descuento,codigo_cupon,$id_cupon,id_cupon",
            'tipo_descuento' => ['required', Rule::in(['Porcentaje', 'Valor fijo'])],
            'valor_comprado' => 'required|int|min:0',
            'valor' => 'required|numeric|min:0.01',
            'fecha_expiracion' => 'required|date|after_or_equal:today',
            'cantidad_prudcutos_minimos' => 'nullable|int|min:1',
            'max_usos_por_cliente' => 'nullable|int|min:1',
        ]);

        $cupon->fill([
            'codigo_cupon' => $request->input('codigo_cupon'),
            'tipo_descuento' => $request->input('tipo_descuento'),
            'valor_comprado' => $request->input('valor_comprado'),
            'valor' => $request->input('valor'),
            'fecha_expiracion' => $request->input('fecha_expiracion'),
            'activo' => $request->has('activo') ? 1 : 0,
            'cantidad_prudcutos_minimos' => $request->input('cantidad_prudcutos_minimos', 1),
            'max_usos_por_cliente' => $request->input('max_usos_por_cliente', 1),
        ])->save();

        return back()->with('success', 'Cupón actualizado correctamente');
    }

    /**
     * Eliminar cupón
     */
    public function destroy(int $id_cupon)
    {
        $cupon = Coupon::findOrFail($id_cupon);
        $cupon->delete();

        return back()->with('success', 'Cupón eliminado correctamente');
    }
}