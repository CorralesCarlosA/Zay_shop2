<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\PedidosModel;

class PedidosController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth'); // Protección de autenticación
    }*/

    // Vista de pedidos
    public function pedidos()
    {
        return view('admin.pedidos.index');
    }

    // Listar pedidos en proceso
    public function listarPedidos()
    {
        $pedidos = PedidosModel::where('proceso', 1)->get();

        foreach ($pedidos as $pedido) {
            $pedido->accion = '<div class="d-flex">
                <button class="btn btn-success" type="button" onclick="verPedido(' . $pedido->id . ')"><i class="fas fa-eye"></i></button>
                <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $pedido->id . ', 2)"><i class="fas fa-check-circle"></i></button>
            </div>';
        }

        return response()->json($pedidos);
    }

    // Listar pedidos en proceso de finalización
    public function listarProceso()
    {
        $pedidos = PedidosModel::where('proceso', 2)->get();

        foreach ($pedidos as $pedido) {
            $pedido->accion = '<div class="d-flex">
                <button class="btn btn-success" type="button" onclick="verPedido(' . $pedido->id . ')"><i class="fas fa-eye"></i></button>
                <button class="btn btn-info" type="button" onclick="cambiarProceso(' . $pedido->id . ', 3)"><i class="fas fa-check-circle"></i></button>
            </div>';
        }

        return response()->json($pedidos);
    }

    // Listar pedidos finalizados
    public function listarFinalizados()
    {
        $pedidos = PedidosModel::where('proceso', 3)->get();

        foreach ($pedidos as $pedido) {
            $pedido->accion = '<div class="d-flex">
                <button class="btn btn-success" type="button" onclick="verPedido(' . $pedido->id . ')"><i class="fas fa-eye"></i></button>
            </div>';
        }

        return response()->json($pedidos);
    }

    // Actualizar estado de un pedido
    public function update(Request $request)
    {
        $request->validate([
            'idPedido' => 'required|numeric',
            'proceso' => 'required|numeric'
        ]);

        $pedido = PedidosModel::find($request->idPedido);
        if (!$pedido) {
            return response()->json(['msg' => 'Pedido no encontrado', 'icono' => 'error']);
        }

        $pedido->update(['proceso' => $request->proceso]);

        return response()->json(['msg' => 'Pedido actualizado', 'icono' => 'success']);
    }
}
