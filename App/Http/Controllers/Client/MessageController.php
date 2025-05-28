<?php

namespace App\Http\Controllers\Client;

use App\Models\client\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar historial de mensajes del cliente autenticado
     */
    public function index(Request $request)
    {
        // Obtenemos el cliente desde sesión o autenticación personalizada
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        // Cargamos todos los mensajes del cliente con relación al administrador (si hay respuesta)
        $messages = Message::where('n_identificacion_cliente', $clienteId)
            ->with(['administrator'])
            ->get();

        return view('client.mensajes.index', compact('messages'));
    }

    /**
     * Mostrar formulario para nuevo mensaje al soporte
     */
    public function create()
    {
        return view('client.mensajes.create');
    }

    /**
     * Guardar nuevo mensaje
     */
    public function store(Request $request)
    {
        // Obtenemos el cliente desde sesión
        $clienteId = $request->session()->get('cliente_id');

        if (!$clienteId) {
            return redirect()->route('client.login')->with('error', 'Debe iniciar sesión');
        }

        // Validación avanzada
        $validator = Validator::make($request->all(), [
            'asunto' => 'required|string|max:100',
            'mensaje' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $request->only([
            'asunto',
            'mensaje'
        ]);

        $validated['n_identificacion_cliente'] = $clienteId;
        $validated['estado_mensaje'] = 'Abierto';
        $validated['fecha_envio'] = now()->toDateTimeString();
        $validated['hora_envio'] = now()->format('H:i:s');

        $message = new Message($validated);
        $message->save();

        return redirect()->route('client.mensajes.show', $message->id_mensaje)
            ->with('success', 'Mensaje enviado correctamente');
    }

    /**
     * Mostrar detalles de un mensaje
     */
    public function show(int $id_mensaje)
    {
        $message = Message::with(['administrator'])->findOrFail($id_mensaje);

        // Asegurarnos de que sea del cliente autenticado
        $clienteId = request()->session()->get('cliente_id');

        if ($message->n_identificacion_cliente !== $clienteId) {
            return abort(403, 'No tienes acceso a este mensaje');
        }

        return view('client.mensajes.show', compact('message'));
    }
}
