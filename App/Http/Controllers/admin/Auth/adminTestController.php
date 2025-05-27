<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\admin\Administrator;
use Illuminate\Support\Facades\Hash;

class AdminTestController extends Controller
{
/**
* Crear un administrador de prueba
*/
public function createAdmin()
{
$admin = Administrator::create([
'nombres' => 'Prueba',
'apellidos' => 'Sistema',
'correoE' => 'adminis@adminis.com',
'password' => Hash::make('admin1234'),
'estado_administrador' => 1,
'id_rol_admin' => 1, // Asegúrate de tener este rol creado
'n_identificacion' => 'ADMIN001'
]);

return "Administrador creado: " . $admin->correoE;
}
}