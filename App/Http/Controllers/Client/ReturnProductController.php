<?php

namespace App\Http\Controllers\client;

use App\Models\client\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Sale;

class ReturnProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las devoluciones del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        $returns = ReturnProduct::where('n_identificacion_cliente', $clienteId)->with(['sale.product'])->get();
        return view('client.devoluciones.index', compact('returns'));
    }

    /**
     * Mostrar formulario para nueva devolución
     */
    public function create(Request $request)
    {
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        // Traer solo ventas del cliente que pueden ser devueltas
        $ventas = Sale::where('n_identificacion_cliente', $clienteId)->where('estado_venta', 'Completada')->get();

        return view('client.devoluciones.create', compact('ventas'));
    }

    /**
     * Guardar nueva solicitud de devolución
     */
    public function store(Request $request)
    {
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        $validator = Validator::make($request->all(), [
            'id_venta' => 'required|exists:ventas,id_venta',
            'motivo_devolucion' => 'required|string',
            'estado_devolucion' => ['required', Rule::in(['Pendiente', 'Aprobada', 'Rechazada', 'Completada'])],
            'comentarios_cliente' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'id_venta',
            'motivo_devolucion',
            'comentarios_cliente'
        ]);

        $validated['n_identificacion_cliente'] = $clienteId;
        $validated['estado_devolucion'] = 'Pendiente';
        $validated['fecha_solicitud'] = now()->toDateTimeString();
        $validated['hora_solicitud'] = now()->format('H:i:s');

        $return = new ReturnProduct($validated);
        $return->save();

        return redirect()->route('client.devoluciones.show', $return->id_devolucion)
            ->with('success', 'Solicitud de devolución enviada');
    }

    /**
     * Mostrar detalles de una devolución
     */
    public function show(int $id_devolucion)
    {
        $return = ReturnProduct::with(['sale.product', 'sale.shippingCity'])->findOrFail($id_devolucion);
        return view('client.devoluciones.show', compact('return'));
    }

    /**
     * Eliminar una solicitud de devolución (si aplica)
     */
    public function destroy(int $id_devolucion)
    {
        $return = ReturnProduct::findOrFail($id_devolucion);

        if ($return->estado_devolucion !== 'Pendiente') {
            return back()->with('error', 'Solo puedes eliminar devoluciones Pendientes');
        }

        $return->delete();
        return back()->with('success', 'Devolución eliminada correctamente');
    }
}
