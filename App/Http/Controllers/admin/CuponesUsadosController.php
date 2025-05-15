<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\CouponUsed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\client\Client;
use App\Models\admin\Coupon;

class CuponesUsadosController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los registros de cupones usados
     */
    public function index()
    {
        $couponUsages = CouponUsed::with(['client', 'coupon'])->get();
        return view('admin.cupones.usados.index', compact('couponUsages'));
    }

    /**
     * Mostrar formulario para nuevo registro de cupón usado
     */
    public function create()
    {
        $clients = Client::all();
        $coupons = Coupon::all();

        return view('admin.cupones.usados.create', compact('clients', 'coupons'));
    }

    /**
     * Guardar nuevo registro de cupón usado
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'id_cupon' => 'required|exists:cupones_descuento,id_cupon',
            'fecha_uso' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'n_identificacion_cliente',
            'id_cupon'
        ]);

        // Si no se proporciona fecha, usar ahora
        $validated['fecha_uso'] = $request->input('fecha_uso') ?: now();

        $couponUsed = new CouponUsed($validated);
        $couponUsed->save();

        return redirect()->route('admin.cupones.usados.show', $couponUsed->id_cupon_usado)
            ->with('success', 'Cupón usado registrado correctamente');
    }

    /**
     * Mostrar detalles de un registro de cupón usado
     */
    public function show(int $id_cupon_usado)
    {
        $record = CouponUsed::with(['client', 'coupon'])->findOrFail($id_cupon_usado);
        return view('admin.cupones.usados.show', compact('record'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_cupon_usado)
    {
        $record = CouponUsed::with(['client', 'coupon'])->findOrFail($id_cupon_usado);
        $clients = Client::all();
        $coupons = Coupon::all();

        return view('admin.cupones.usados.edit', compact('record', 'clients', 'coupons'));
    }

    /**
     * Actualizar registro de cupón usado
     */
    public function update(Request $request, int $id_cupon_usado)
    {
        $record = CouponUsed::findOrFail($id_cupon_usado);

        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientes,n_identificacion',
            'id_cupon' => 'required|exists:cupones_descuento,id_cupon',
            'fecha_uso' => 'required|date'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'n_identificacion_cliente',
            'id_cupon',
            'fecha_uso'
        ]);

        $record->fill($data)->save();

        return redirect()->route('admin.cupones.usados.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Eliminar registro de cupón usado
     */
    public function destroy(int $id_cupon_usado)
    {
        $record = CouponUsed::findOrFail($id_cupon_usado);
        $record->delete();

        return back()->with('success', 'Registro eliminado correctamente');
    }
}
