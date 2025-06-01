<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\client\Client;
use App\Models\admin\Administrator;

class MessageController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar todos los mensajes de soporte
     */
    public function index()
    {
        $messages = Message::with(['client', 'administrator'])->get();
        return view('admin.mensajes.index', compact('messages'));
    }

    /**
     * Mostrar formulario para nuevo mensaje
     */
    public function create()
    {
        $clients = Client::all();
        $administrators = Administrator::all();

        return view('admin.mensajes.create', compact('clients', 'administrators'));
    }

    /**
     * Guardar nuevo mensaje de soporte
     */
    public function store(Request $request)
    {
        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientesn_identificacion',
            'asunto' => 'required|string|max:100',
            'mensaje' => 'required|string',
            'estado_mensaje' => ['required', Rule::in(['Abierto', 'Respondido', 'Cerrado'])],
            'fecha_envio' => 'nullable|date',
            'hora_envio' => 'nullable|date_format:H:i:s',
            'respuesta' => 'nullable|string',
            'fecha_respuesta' => 'nullable|date',
            'hora_respuesta' => 'nullable|date_format:H:i:s',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'n_identificacion_cliente',
            'asunto',
            'mensaje',
            'estado_mensaje',
            'respuesta',
            'fecha_respuesta',
            'hora_respuesta',
            'id_administrador'
        ]);

        // Si no se proporciona fecha/hora de envío
        $validated['fecha_envio'] = $request->input('fecha_envio') ?: now()->toDateTimeString();
        $validated['hora_envio'] = $request->input('hora_envio') ?: now()->format('H:i:s');

        $message = new Message($validated);
        $message->save();

        return redirect()->route('admin.mensajes.show', $message->id_mensaje)
            ->with('success', 'Mensaje guardado correctamente');
    }

    /**
     * Mostrar detalles de un mensaje
     */
    public function show(int $id_mensaje)
    {
        $mensaje = Message::with(['client'])->findOrFail($id_mensaje);
        return view('admin.mensajes.show', compact('mensaje'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(int $id_mensaje)
    {
        $message = Message::with(['client', 'administrator'])->findOrFail($id_mensaje);
        $clients = Client::all();
        $administrators = Administrator::all();

        return view('admin.mensajes.edit', compact('message', 'clients', 'administrators'));
    }

    /**
     * Actualizar datos de un mensaje
     */
    public function update(Request $request, int $id_mensaje)
    {
        $message = Message::findOrFail($id_mensaje);

        $validator = Validator::make($request->all(), [
            'n_identificacion_cliente' => 'required|string|max:10|exists:clientesn_identificacion',
            'asunto' => 'required|string|max:100',
            'mensaje' => 'required|string',
            'estado_mensaje' => ['required', Rule::in(['Abierto', 'Respondido', 'Cerrado'])],
            'fecha_envio' => 'required|date',
            'hora_envio' => 'required|date_format:H:i:s',
            'respuesta' => 'nullable|string',
            'fecha_respuesta' => 'nullable|date',
            'hora_respuesta' => 'nullable|date_format:H:i:s',
            'id_administrador' => 'nullable|exists:administradores,id_administrador'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'n_identificacion_cliente',
            'asunto',
            'mensaje',
            'estado_mensaje',
            'respuesta',
            'fecha_respuesta',
            'hora_respuesta',
            'id_administrador'
        ]);

        // Asignar fecha y hora manualmente si vienen en request
        $data['fecha_envio'] = $request->input('fecha_envio') ?: now()->toDateTimeString();
        $data['hora_envio'] = $request->input('hora_envio') ?: now()->format('H:i:s');

        $message->fill($data)->save();

        return redirect()->route('admin.mensajes.index')
            ->with('success', 'Mensaje actualizado correctamente');
    }

    /**
     * Eliminar mensaje de soporte
     */
    public function destroy(int $id_mensaje)
    {
        $message = Message::findOrFail($id_mensaje);
        $message->delete();

        return back()->with('success', 'Mensaje eliminado correctamente');
    }
}
