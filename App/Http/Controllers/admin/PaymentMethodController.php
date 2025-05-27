<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\PaymentMethod;
use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
/**
* Mostrar lista de métodos de pago
*/
public function index()
{
$metodosPago = PaymentMethod::with('admin')->get();
return view('admin.metodos_pago.index', compact('metodosPago'));
}

/**
* Mostrar formulario para crear método de pago
*/
public function create()
{
$admins = Administrator::all();
return view('admin.metodos_pago.create', compact('admins'));
}

/**
* Guardar nuevo método de pago
*/
public function store(Request $request)
{
$validated = $request->validate([
'nombre' => 'required|string|max:50|unique:metodos_pago,nombre',
'tipo' => ['required', Rule::in(['Efectivo', 'Tarjeta', 'Transferencia Bancaria', 'PayU', 'Mercado Pago', 'PayPal',
'Nequi', 'Daviplata', 'PSE', 'QR'])],
'activo' => 'nullable|boolean',
'descripcion' => 'nullable|string',
'configuracion_adicional' => 'nullable|json',
'id_administrador' => 'required|int|exists:administradores,id_administrador'
]);

PaymentMethod::create([
'nombre' => $validated['nombre'],
'tipo' => $validated['tipo'],
'activo' => $request->has('activo'),
'descripcion' => $validated['descripcion'] ?? null,
'configuracion_adicional' => $request->input('configuracion_adicional') ?? null,
'id_administrador' => $validated['id_administrador']
]);

return redirect()->route('admin.metodos_pago.index')
->with('success', 'Método de pago creado correctamente');
}

/**
* Mostrar detalles de un método de pago
*/
public function show(int $id_metodo_pago)
{
$metodoPago = PaymentMethod::with('admin')->findOrFail($id_metodo_pago);
return view('admin.metodos_pago.show', compact('metodoPago'));
}

/**
* Mostrar formulario de edición
*/
public function edit(int $id_metodo_pago)
{
$metodoPago = PaymentMethod::findOrFail($id_metodo_pago);
$admins = Administrator::all();

return view('admin.metodos_pago.edit', compact('metodoPago', 'admins'));
}

/**
* Actualizar método de pago
*/
public function update(Request $request, int $id_metodo_pago)
{
$metodoPago = PaymentMethod::findOrFail($id_metodo_pago);

$validated = $request->validate([
'nombre' => 'required|string|max:50|unique:metodos_pago,nombre,' . $id_metodo_pago . ',id_metodo_pago',
'tipo' => ['required', Rule::in(['Efectivo', 'Tarjeta', 'Transferencia Bancaria', 'PayU', 'Mercado Pago', 'PayPal',
'Nequi', 'Daviplata', 'PSE', 'QR'])],
'activo' => 'nullable|boolean',
'descripcion' => 'nullable|string',
'configuracion_adicional' => 'nullable|json',
'id_administrador' => 'required|int|exists:administradores,id_administrador'
]);

$metodoPago->fill([
'nombre' => $validated['nombre'],
'tipo' => $validated['tipo'],
'activo' => $request->has('activo'),
'descripcion' => $validated['descripcion'] ?? null,
'configuracion_adicional' => $request->input('configuracion_adicional') ?? null,
'id_administrador' => $validated['id_administrador']
])->save();

return redirect()->route('admin.metodos_pago.index')
->with('success', 'Método de pago actualizado correctamente');
}

/**
* Eliminar método de pago
*/
public function destroy(int $id_metodo_pago)
{
$metodoPago = PaymentMethod::findOrFail($id_metodo_pago);

if ($metodoPago->orders()->count() > 0 || $metodoPago->sales()->count() > 0) {
return back()->withErrors(['error' => 'No puedes eliminar este método. Está siendo usado en ventas o pedidos']);
}

$metodoPago->delete();

return back()->with('success', 'Método de pago eliminado correctamente');
}
}