// app/Http/Controllers/client/ClientController.php

<?php

namespace App\Http\Controllers\client;

use App\Models\client\Client;
use Illuminate\Http\Request;

class ClientController extends \App\Http\Controllers\Controller
{
    /**
     * Mostrar dashboard del cliente logueado
     */
    public function dashboard()
    {
        $cliente = session('client');
        return view('client.dashboard.index', compact('cliente'));
    }

    /**
     * Perfil del cliente
     */
    public function perfil()
    {
        $cliente = Client::findOrFail(session('client.n_identificacion'));
        return view('client.perfil.index', compact('cliente'));
    }

    /**
     * Actualizar datos del perfil
     */
    public function update(Request $request)
    {
        $cliente = Client::findOrFail(session('client.n_identificacion'));

        $validated = $request->validate([
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'correoE' => "required|email|unique:clientes,correoE,{$cliente->n_identificacion},n_identificacion",
            'n_telefono' => 'required|string|max:10|min:10',
            'Direccion_recidencia' => 'required|string',
            'ciudad' => 'required|int|exists:ciudades,id_ciudad',
        ]);

        $cliente->fill($validated)->save();

        session(['client' => $cliente]);

        return back()->with('success', 'Perfil actualizado correctamente');
    }
}
