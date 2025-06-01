<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Sale;
use App\Models\admin\Administrator;
use App\Models\client\Client;

class ReturnProductController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todas las devoluciones
     */
    public function index()
    {
        $returns = ReturnProduct::with(['sale', 'client', 'administrator'])->get();
        return view('admin.devoluciones.index', compact('returns'));
    }

    /**
     * Mostrar formulario para nueva devolución
     */
    public function create()
    {
        $sales = Sale::all();
        $clients = Client::all();
        $administrators = Administrator::all();

        return view('admin.devoluciones.create', compact('sales', 'clients', 'administrators'));
    }

    /**
     * Guardar nueva devolución
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientesn_identificacion',
            'motivo_devolucion' => 'nullable|string',
            'estado_devolucion' => ['required', Rule::in(['Pendiente', 'Aprobada', 'Rechazada', 'Completada'])],
            'fecha_solicitud' => 'nullable|date',
            'hora_solicitud' => 'nullable|date_format:H:i:s',
            'comentarios_cliente' => 'nullable|string',
            'comentarios_administrador' => 'nullable|string',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'n_identificacion_cliente',
            'motivo_devolucion',
            'estado_devolucion',
            'comentarios_cliente',
            'comentarios_administrador',
            'id_administrador'
        ]);

        // Si no se proporciona fecha/hora, usar ahora
        $validated['fecha_solicitud'] = $request->input('fecha_solicitud') ?: now()->toDateTimeString();
        $validated['hora_solicitud'] = $request->input('hora_solicitud') ?: now()->format('H:i:s');

        // Si hay id_venta, validar que exista
        if ($request->filled('id_venta')) {
            $validated['id_venta'] = $request->input('id_venta');
        }

        $return = new ReturnProduct($validated);
        $return->save();

        return redirect()->route('admin.devoluciones.show', $return->id_devolucion)
            ->with('success', 'Devolución creada correctamente');
    }

    /**
     * Mostrar detalles de una devolución
     */
    public function show(int $id_devolucion)
    {
        $return = ReturnProduct::with(['sale', 'client', 'administrator'])->findOrFail($id_devolucion);
        return view('admin.devoluciones.show', compact('return'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_devolucion)
    {
        $return = ReturnProduct::with(['sale', 'client', 'administrator'])->findOrFail($id_devolucion);
        $sales = Sale::all();
        $clients = Client::all();
        $administrators = Administrator::all();

        return view('admin.devoluciones.edit', compact('return', 'sales', 'clients', 'administrators'));
    }

    /**
     * Actualizar datos de devolución
     */
    public function update(Request $request, int $id_devolucion)
    {
        $return = ReturnProduct::findOrFail($id_devolucion);

        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientesn_identificacion',
            'motivo_devolucion' => 'nullable|string',
            'estado_devolucion' => ['required', Rule::in(['Pendiente', 'Aprobada', 'Rechazada', 'Completada'])],
            'fecha_solicitud' => 'required|date',
            'hora_solicitud' => 'required|date_format:H:i:s',
            'comentarios_cliente' => 'nullable|string',
            'comentarios_administrador' => 'nullable|string',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'n_identificacion_cliente',
            'motivo_devolucion',
            'estado_devolucion',
            'comentarios_cliente',
            'comentarios_administrador',
            'id_administrador'
        ]);

        // Si hay id_venta, validar que exista
        if ($request->filled('id_venta')) {
            $data['id_venta'] = $request->input('id_venta');
        }

        // Asignar fecha y hora manualmente si vienen en request
        $data['fecha_solicitud'] = $request->input('fecha_solicitud') ?: now()->toDateTimeString();
        $data['hora_solicitud'] = $request->input('hora_solicitud') ?: now()->format('H:i:s');

        $return->fill($data)->save();

        return redirect()->route('admin.devoluciones.index')
            ->with('success', 'Devolución actualizada correctamente');
    }

    /**
     * Eliminar devolución (si aplica)
     */
    public function destroy(int $id_devolucion)
    {
        $return = ReturnProduct::findOrFail($id_devolucion);
        $return->delete();

        return back()->with('success', 'Devolución eliminada correctamente');
    }
}
