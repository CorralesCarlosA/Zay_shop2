<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Listado con filtros avanzados
    public function index(Request $request)
{
        $query = Client::withTrashed();
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nombres', 'like', "%{$request->search}%")
                  ->orWhere('apellidos', 'like', "%{$request->search}%")
                  ->orWhere('n_identificacion', 'like', "%{$request->search}%")
                  ->orWhere('correoE', 'like', "%{$request->search}%");
            });
        }
        
        if ($request->filled('estado')) {
            $query->where('estado_cliente', $request->estado);
        }
        
        $clientes = $query->orderBy('n_identificacion', 'desc')->paginate(20);
        
        return view('admin.clientes.index', compact('clientes'));
    }


    // Formulario de edición COMPLETO
    public function edit($id)
    {
           $client = Client::where('n_identificacion', $id)->firstOrFail(); // ✔️

    
        $estadosCiviles = ['Soltero', 'Casado', 'Divorciado', 'Viudo'];
        
        return view('admin.clients.edit', compact('client', 'paises', 'estadosCiviles'));
    }

    // Actualización de TODOS los campos
    public function update(Request $request, $id)
    {
            $client = Client::where('n_identificacion', $id)->firstOrFail(); 
        $rules = [
            'n_identificacion' => 'required|integer|unique:clientsn_identificacion,'.$id.'n_identificacion',
            'dni' => 'required|string|max:20|unique:clients,dni,'.$id.'n_identificacion',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'sexo' => 'nullable|in:M,F,Otro',
            'fecha_nacimiento' => 'nullable|date',
            'correoE' => 'required|email|unique:clients,email,'.$id.'n_identificacion',
            'password' => 'nullable|string|min:8|confirmed',
            // ... validar todos los demás campos
        ];
        
        $data = $request->validate($rules);
        
        // Manejo especial de campos
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        
        // Actualización incluso con soft delete
        $client->update($data);
        
        // Restaurar si estaba eliminado
        if ($client->trashed() && $request->restaurar) {
            $client->restore();
        }
        
        return redirect()->route('admin.clients.show', $client->n_identificacion)
            ->with('success', 'Cliente actualizado completamente');
    }

    // Eliminación (soft delete)
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        
        return back()->with('success', 'Cliente desactivado (en papelera)');
    }

    // Eliminación PERMANENTE
    public function forceDelete($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->forceDelete();
        
        return redirect()->route('admin.clients.index')
            ->with('warning', 'Cliente eliminado permanentemente');
    }
}