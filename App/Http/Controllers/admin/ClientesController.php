<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\admin\ClientesModel;
use App\Models\admin\CategoriasModel;
use App\Models\admin\PedidosModel;
use App\Models\admin\ProductosModel;
use App\Models\admin\detallepedido;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['registroDirecto', 'loginDirecto', 'verificarCorreo', 'enviarCorreo']);
    }

    // Mostrar perfil del usuario
    public function index()
    {
        $cliente = Auth::user();
        $categorias = CategoriasModel::where('estado', 1)->get();
        return view('clientes.perfil', compact('cliente', 'categorias'));
    }

    // Registro de cliente
    public function registroDirecto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes,correo',
            'clave' => 'required|min:6'
        ]);

        $cliente = ClientesModel::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'clave' => bcrypt($request->clave),
            'token' => md5($request->correo),
            'estado' => 1
        ]);

        Auth::login($cliente);
        return response()->json(['msg' => 'Registrado con éxito', 'icono' => 'success', 'token' => $cliente->token]);
    }

    // Envío de correo de verificación
    public function enviarCorreo(Request $request)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->correo);

            $mail->isHTML(true);
            $mail->Subject = 'Verifica tu correo';
            $mail->Body = 'Para verificar tu correo en nuestra tienda <a href="' . route('clientes.verificar', $request->token) . '">Clic aquí</a>';

            $mail->send();
            return response()->json(['msg' => 'Correo enviado, revisa tu bandeja de entrada', 'icono' => 'success']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'Error al enviar correo: ' . $mail->ErrorInfo, 'icono' => 'error']);
        }
    }

    // Verificación de correo
    public function verificarCorreo($token)
    {
        $cliente = ClientesModel::where('token', $token)->first();
        if ($cliente) {
            $cliente->update(['token' => null, 'estado' => 1]);
            return redirect()->route('clientes.perfil')->with('success', 'Correo verificado');
        }
        return redirect()->route('login')->with('error', 'Token inválido');
    }

    // Login de clientes
    public function loginDirecto(Request $request)
    {
        $request->validate([
            'correoLogin' => 'required|email',
            'claveLogin' => 'required'
        ]);

        $cliente = ClientesModel::where('correo', $request->correoLogin)->first();

        if ($cliente && password_verify($request->claveLogin, $cliente->clave)) {
            Auth::login($cliente);
            return response()->json(['msg' => 'OK', 'icono' => 'success']);
        }
        return response()->json(['msg' => 'Credenciales incorrectas', 'icono' => 'error']);
    }

    // Registrar un pedido
    public function registrarPedido(Request $request)
    {
        $pedido = PedidosModel::create([
            'id_transaccion' => $request->id_transaccion,
            'monto' => $request->monto,
            'estado' => $request->estado,
            'fecha' => now(),
            'email' => $request->email,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'id_cliente' => Auth::id()
        ]);

        foreach ($request->productos as $producto) {
            DetallePedido::create([
                'producto' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $producto['cantidad'],
                'id_pedido' => $pedido->id,
                'id_producto' => $producto['idProducto']
            ]);
        }

        return response()->json(['msg' => 'Pedido registrado', 'icono' => 'success']);
    }

    // Listar pedidos pendientes
    public function listarPendientes()
    {
        $pedidos = PedidosModel::where('id_cliente', Auth::id())->get();
        return response()->json($pedidos);
    }

    // Ver detalles de un pedido
    public function verPedido($idPedido)
    {
        $pedido = PedidosModel::find($idPedido);
        $productos = DetallePedido::where('id_pedido', $idPedido)->get();
        return response()->json(['pedido' => $pedido, 'productos' => $productos]);
    }

    // Cerrar sesión
    public function salir()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
