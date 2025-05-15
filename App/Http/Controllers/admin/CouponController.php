<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CouponController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los cupones de descuento
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.cupones.index', compact('coupons'));
    }

    /**
     * Mostrar formulario para nuevo cupón
     */
    public function create()
    {
        return view('admin.cupones.create');
    }

    /**
     * Guardar nuevo cupón de descuento
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'nombre_cupon' => 'required|string|max:50',
            'codigo_cupon' => 'required|string|max:50|unique:cupones_descuento,codigo_cupon',
            'tipo_descuento' => ['required', Rule::in(['Porcentaje', 'Valor fijo'])],
            'valor' => 'required|numeric|min:0',
            'fecha_expiracion' => 'required|date|after_or_equal:today',
            'activo' => 'boolean',
            'cantidad_productos_minimos' => 'integer|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'nombre_cupon',
            'codigo_cupon',
            'tipo_descuento',
            'valor',
            'fecha_expiracion',
            'activo',
            'cantidad_productos_minimos'
        ]);

        $coupon = new Coupon($validated);
        $coupon->save();

        return redirect()->route('admin.cupones.index')
            ->with('success', 'Cupón creado correctamente');
    }

    /**
     * Mostrar detalles de un cupón
     */
    public function show(int $id_cupon)
    {
        $coupon = Coupon::findOrFail($id_cupon);
        return view('admin.cupones.show', compact('coupon'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_cupon)
    {
        $coupon = Coupon::findOrFail($id_cupon);
        return view('admin.cupones.edit', compact('coupon'));
    }

    /**
     * Actualizar datos del cupón
     */
    public function update(Request $request, int $id_cupon)
    {
        $coupon = Coupon::findOrFail($id_cupon);

        $validator = Validator::make($request->all(), [
            'nombre_cupon' => 'required|string|max:50',
            'codigo_cupon' => 'required|string|max:50|unique:cupones_descuento,codigo_cupon,' . $id_cupon . ',id_cupon',
            'tipo_descuento' => ['required', Rule::in(['Porcentaje', 'Valor fijo'])],
            'valor' => 'required|numeric|min:0',
            'fecha_expiracion' => 'required|date|after_or_equal:today',
            'activo' => 'boolean',
            'cantidad_productos_minimos' => 'integer|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'nombre_cupon',
            'codigo_cupon',
            'tipo_descuento',
            'valor',
            'fecha_expiracion',
            'activo',
            'cantidad_productos_minimos'
        ]);

        $coupon->fill($data)->save();

        return redirect()->route('admin.cupones.index')
            ->with('success', 'Cupón actualizado correctamente');
    }

    /**
     * Eliminar cupón de descuento
     */
    public function destroy(int $id_cupon)
    {
        $coupon = Coupon::findOrFail($id_cupon);
        $coupon->delete();

        return back()->with('success', 'Cupón eliminado correctamente');
    }
}
