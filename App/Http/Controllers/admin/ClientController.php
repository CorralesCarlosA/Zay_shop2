<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Mostrar listado de clientes
     */
    public function index()
    {
        try {
            $clientes = Client::with(['pedidos', 'facturas'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);

            return view('admin.clientes.index', compact('clientes'));
            
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error al cargar clientes: '.$e->getMessage());
        }
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Almacenar nuevo cliente
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_identificacion' => 'required|string|unique:clientes',
            'tipo_identificacion' => 'required|in:Cédula,Pasaporte,RUC',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:clientes',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:Masculino,Femenino,Otro'
        ]);

        try {
            $cliente = Client::create($validated);
            return redirect()->route('admin.clientes.show', $cliente->id)
                           ->with('success', 'Cliente creado exitosamente');
                           
        } catch (\Exception $e) {
            return back()->withInput()
                       ->with('error', 'Error al crear cliente: '.$e->getMessage());
        }
    }

    /**
     * Mostrar detalles del cliente
     */
    public function show($id)
    {
        try {
            $cliente = Client::with(['pedidos' => function($query) {
                                $query->orderBy('fecha_pedido', 'desc');
                             }, 'facturas'])
                             ->findOrFail($id);

            return view('admin.clientes.show', compact('cliente'));
            
        } catch (\Exception $e) {
            return redirect()->route('admin.clientes.index')
                           ->with('error', 'Cliente no encontrado');
        }
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        try {
            $cliente = Client::findOrFail($id);
            return view('admin.clientes.edit', compact('cliente'));
            
        } catch (\Exception $e) {
            return redirect()->route('admin.clientes.index')
                           ->with('error', 'Cliente no encontrado');
        }
    }

    /**
     * Actualizar cliente
     */
    public function update(Request $request, $id)
    {
        $cliente = Client::findOrFail($id);

        $validated = $request->validate([
            'n_identificacion' => [
                'required',
                'string',
                Rule::unique('clientes')->ignore($cliente->id)
            ],
            'tipo_identificacion' => 'required|in:Cédula,Pasaporte,RUC',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|string|max:15',
            'email' => [
                'required',
                'email',
                Rule::unique('clientes')->ignore($cliente->id)
            ],
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:Masculino,Femenino,Otro'
        ]);

        try {
            $cliente->update($validated);
            return redirect()->route('admin.clientes.show', $cliente->id)
                           ->with('success', 'Cliente actualizado exitosamente');
                           
        } catch (\Exception $e) {
            return back()->withInput()
                       ->with('error', 'Error al actualizar cliente: '.$e->getMessage());
        }
    }

    /**
     * Eliminar cliente
     */
    public function destroy($id)
    {
        try {
            $cliente = Client::findOrFail($id);
            
            // Verificar si tiene pedidos asociados
            if($cliente->pedidos()->count() > 0) {
                return back()->with('error', 'No se puede eliminar, el cliente tiene pedidos asociados');
            }
            
            $cliente->delete();
            return redirect()->route('admin.clientes.index')
                           ->with('success', 'Cliente eliminado exitosamente');
                           
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar cliente: '.$e->getMessage());
        }
    }

    /**
     * Mostrar historial de movimientos
     */
    public function movimientos($id)
    {
        try {
            $cliente = Client::with(['pedidos', 'facturas'])->findOrFail($id);
            return view('admin.clientes.movimientos', compact('cliente'));
            
        } catch (\Exception $e) {
            return redirect()->route('admin.clientes.index')
                           ->with('error', 'Error al cargar movimientos: '.$e->getMessage());
        }
    }
}