<?php
// Route::get('/', function () {
//     return view('welcome');
// });

//#region Rutas del Administrador

// inicior creadas el dia 14 /  05 2025
use App\Http\Controllers\admin\ProductController;

use App\Http\Controllers\admin\CityController;

use App\Http\Controllers\Client\ClientController;

use App\Http\Controllers\admin\AdministratorController;

use App\Http\Controllers\admin\CategoryController;

use App\Http\Controllers\admin\OfferStatusController;

use App\Http\Controllers\admin\OfferTypeController;

use App\Http\Controllers\admin\ColorController;

use App\Http\Controllers\admin\ClassProductController;

use App\Http\Controllers\admin\GenderProductController;

use App\Http\Controllers\admin\ProductStatusController;

use App\Http\Controllers\admin\AdminRoleController;

use App\Http\Controllers\admin\CouponController;

use App\Http\Controllers\admin\DepartmentController;

use App\Http\Controllers\admin\SaleController;

use App\Http\Controllers\admin\OrderController;

use App\Http\Controllers\admin\ReturnProductController;

use App\Http\Controllers\admin\MessageController;

use App\Http\Controllers\admin\InventoryController;

use App\Http\Controllers\admin\HistorialPreciosController;

use App\Http\Controllers\admin\OfertasPorCategoriaController;

use App\Http\Controllers\admin\CuponesUsadosController;

use App\Http\Controllers\admin\CartItemController;


//#endregion





use App\Http\Controllers\admin\Admin;
use App\Http\Controllers\ControllerUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\UseController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\admin\AdAuthController;
use App\Http\Controllers\visualizadorModelos;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// #region rutas del Cliente
// DEFINICION DE LAS RUNTAS DE PARTE DEL CLIENTE




// controladores del perfil del usuario
Route::prefix('cliente')->middleware('auth.client')->group(function () {
    Route::get('/perfil', [ClientController::class, 'show'])->name('client.perfil.show');
    Route::get('/perfil/editar', [ClientController::class, 'edit'])->name('client.perfil.edit');
    Route::put('/perfil', [ClientController::class, 'update'])->name('client.perfil.update');
});
// final  de las cutas del cliente
// endregion

// #region rutas del administrador`
// DEFINICION DE LAS RUNTAS DE PARTE DEL ADMINISTRADOR

// rutas para gestionar el carrito desde el administrador
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/carrito', [CartItemController::class, 'index'])->name('admin.carrito.index');
    Route::get('/carrito/{id_carrito}', [CartItemController::class, 'show'])->name('admin.carrito.show');
    Route::get('/carrito/{id_carrito}/editar', [CartItemController::class, 'edit'])->name('admin.carrito.edit');
    Route::put('/carrito/{id_carrito}', [CartItemController::class, 'update'])->name('admin.carrito.update');
    Route::delete('/carrito/{id_carrito}', [CartItemController::class, 'destroy'])->name('admin.carrito.destroy');
});


// cupones usados
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/cupones/usados', [CuponesUsadosController::class, 'index'])->name('admin.cupones.usados.index');
    Route::get('/cupones/usados/nuevo', [CuponesUsadosController::class, 'create'])->name('admin.cupones.usados.create');
    Route::post('/cupones/usados', [CuponesUsadosController::class, 'store'])->name('admin.cupones.usados.store');
    Route::get('/cupones/usados/{id_cupon_usado}', [CuponesUsadosController::class, 'show'])->name('admin.cupones.usados.show');
    Route::get('/cupones/usados/{id_cupon_usado}/editar', [CuponesUsadosController::class, 'edit'])->name('admin.cupones.usados.edit');
    Route::put('/cupones/usados/{id_cupon_usado}', [CuponesUsadosController::class, 'update'])->name('admin.cupones.usados.update');
    Route::delete('/cupones/usados/{id_cupon_usado}', [CuponesUsadosController::class, 'destroy'])->name('admin.cupones.usados.destroy');
});

// rutas de ofertas
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/ofertas/categoria', [OfertasPorCategoriaController::class, 'index'])->name('admin.ofertas.categoria.index');
    Route::get('/ofertas/categoria/nueva', [OfertasPorCategoriaController::class, 'create'])->name('admin.ofertas.categoria.create');
    Route::post('/ofertas/categoria', [OfertasPorCategoriaController::class, 'store'])->name('admin.ofertas.categoria.store');
    Route::get('/ofertas/categoria/{id_oferta_categoria}', [OfertasPorCategoriaController::class, 'show'])->name('admin.ofertas.categoria.show');
    Route::get('/ofertas/categoria/{id_oferta_categoria}/editar', [OfertasPorCategoriaController::class, 'edit'])->name('admin.ofertas.categoria.edit');
    Route::put('/ofertas/categoria/{id_oferta_categoria}', [OfertasPorCategoriaController::class, 'update'])->name('admin.ofertas.categoria.update');
    Route::delete('/ofertas/categoria/{id_oferta_categoria}', [OfertasPorCategoriaController::class, 'destroy'])->name('admin.ofertas.categoria.destroy');
});

// rutas de historial de precios
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/historial-precios', [HistorialPreciosController::class, 'index'])->name('admin.historial-precios.index');
    Route::get('/historial-precios/nuevo', [HistorialPreciosController::class, 'create'])->name('admin.historial-precios.create');
    Route::post('/historial-precios', [HistorialPreciosController::class, 'store'])->name('admin.historial-precios.store');
    Route::get('/historial-precios/{id_historial}', [HistorialPreciosController::class, 'show'])->name('admin.historial-precios.show');
    Route::get('/historial-precios/{id_historial}/editar', [HistorialPreciosController::class, 'edit'])->name('admin.historial-precios.edit');
    Route::put('/historial-precios/{id_historial}', [HistorialPreciosController::class, 'update'])->name('admin.historial-precios.update');
    Route::delete('/historial-precios/{id_historial}', [HistorialPreciosController::class, 'destroy'])->name('admin.historial-precios.destroy');
});

// rutas de inventario
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/inventario', [InventoryController::class, 'index'])->name('admin.inventario.index');
    Route::get('/inventario/nuevo', [InventoryController::class, 'create'])->name('admin.inventario.create');
    Route::post('/inventario', [InventoryController::class, 'store'])->name('admin.inventario.store');
    Route::get('/inventario/{id_inventario}', [InventoryController::class, 'show'])->name('admin.inventario.show');
    Route::get('/inventario/{id_inventario}/editar', [InventoryController::class, 'edit'])->name('admin.inventario.edit');
    Route::put('/inventario/{id_inventario}', [InventoryController::class, 'update'])->name('admin.inventario.update');
    Route::delete('/inventario/{id_inventario}', [InventoryController::class, 'destroy'])->name('admin.inventario.destroy');
});

// rutas de mensajes
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/mensajes', [MessageController::class, 'index'])->name('admin.mensajes.index');
    Route::get('/mensajes/nuevo', [MessageController::class, 'create'])->name('admin.mensajes.create');
    Route::post('/mensajes', [MessageController::class, 'store'])->name('admin.mensajes.store');
    Route::get('/mensajes/{id_mensaje}', [MessageController::class, 'show'])->name('admin.mensajes.show');
    Route::get('/mensajes/{id_mensaje}/editar', [MessageController::class, 'edit'])->name('admin.mensajes.edit');
    Route::put('/mensajes/{id_mensaje}', [MessageController::class, 'update'])->name('admin.mensajes.update');
    Route::delete('/mensajes/{id_mensaje}', [MessageController::class, 'destroy'])->name('admin.mensajes.destroy');
});

// rutas de devoluciones
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/devoluciones', [ReturnProductController::class, 'index'])->name('admin.devoluciones.index');
    Route::get('/devoluciones/nueva', [ReturnProductController::class, 'create'])->name('admin.devoluciones.create');
    Route::post('/devoluciones', [ReturnProductController::class, 'store'])->name('admin.devoluciones.store');
    Route::get('/devoluciones/{id_devolucion}', [ReturnProductController::class, 'show'])->name('admin.devoluciones.show');
    Route::get('/devoluciones/{id_devolucion}/editar', [ReturnProductController::class, 'edit'])->name('admin.devoluciones.edit');
    Route::put('/devoluciones/{id_devolucion}', [ReturnProductController::class, 'update'])->name('admin.devoluciones.update');
    Route::delete('/devoluciones/{id_devolucion}', [ReturnProductController::class, 'destroy'])->name('admin.devoluciones.destroy');
});

// rutas de pedidos
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/pedidos', [OrderController::class, 'index'])->name('admin.pedidos.index');
    Route::get('/pedidos/nuevo', [OrderController::class, 'create'])->name('admin.pedidos.create');
    Route::post('/pedidos', [OrderController::class, 'store'])->name('admin.pedidos.store');
    Route::get('/pedidos/{id_pedido}', [OrderController::class, 'show'])->name('admin.pedidos.show');
    Route::get('/pedidos/{id_pedido}/editar', [OrderController::class, 'edit'])->name('admin.pedidos.edit');
    Route::put('/pedidos/{id_pedido}', [OrderController::class, 'update'])->name('admin.pedidos.update');
    Route::delete('/pedidos/{id_pedido}', [OrderController::class, 'destroy'])->name('admin.pedidos.destroy');
});

// Rutas para ventas
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/ventas', [SaleController::class, 'index'])->name('admin.ventas.index');
    Route::get('/ventas/nueva', [SaleController::class, 'create'])->name('admin.ventas.create');
    Route::post('/ventas', [SaleController::class, 'store'])->name('admin.ventas.store');
    Route::get('/ventas/{id_venta}', [SaleController::class, 'show'])->name('admin.ventas.show');
    Route::get('/ventas/{id_venta}/editar', [SaleController::class, 'edit'])->name('admin.ventas.edit');
    Route::put('/ventas/{id_venta}', [SaleController::class, 'update'])->name('admin.ventas.update');
    Route::delete('/ventas/{id_venta}', [SaleController::class, 'destroy'])->name('admin.ventas.destroy');
});

// Rutas para departamentos
Route::prefix('admin')->group(function () {
    Route::get('/departamentos', [DepartmentController::class, 'index'])->name('admin.departamentos.index');
    Route::get('/departamentos/nuevo', [DepartmentController::class, 'create'])->name('admin.departamentos.create');
    Route::post('/departamentos', [DepartmentController::class, 'store'])->name('admin.departamentos.store');
    Route::get('/departamentos/{id_departamento}', [DepartmentController::class, 'show'])->name('admin.departamentos.show');
    Route::get('/departamentos/{id_departamento}/editar', [DepartmentController::class, 'edit'])->name('admin.departamentos.edit');
    Route::put('/departamentos/{id_departamento}', [DepartmentController::class, 'update'])->name('admin.departamentos.update');
    Route::delete('/departamentos/{id_departamento}', [DepartmentController::class, 'destroy'])->name('admin.departamentos.destroy');
});

// Rutas para categorias
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/cupones', [CouponController::class, 'index'])->name('admin.cupones.index');
    Route::get('/cupones/nuevo', [CouponController::class, 'create'])->name('admin.cupones.create');
    Route::post('/cupones', [CouponController::class, 'store'])->name('admin.cupones.store');
    Route::get('/cupones/{id_cupon}', [CouponController::class, 'show'])->name('admin.cupones.show');
    Route::get('/cupones/{id_cupon}/editar', [CouponController::class, 'edit'])->name('admin.cupones.edit');
    Route::put('/cupones/{id_cupon}', [CouponController::class, 'update'])->name('admin.cupones.update');
    Route::delete('/cupones/{id_cupon}', [CouponController::class, 'destroy'])->name('admin.cupones.destroy');
});


// gestion de roles de los administradores
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/roles-administrador', [AdminRoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles-administrador/nuevo', [AdminRoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles-administrador', [AdminRoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles-administrador/{id_rol_admin}', [AdminRoleController::class, 'show'])->name('admin.roles.show');
    Route::get('/roles-administrador/{id_rol_admin}/editar', [AdminRoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles-administrador/{id_rol_admin}', [AdminRoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles-administrador/{id_rol_admin}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy');
});

// gestor de estados de los produtos
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/estados-producto', [ProductStatusController::class, 'index'])->name('admin.productos.estado.index');
    Route::get('/estados-producto/nuevo', [ProductStatusController::class, 'create'])->name('admin.productos.estado.create');
    Route::post('/estados-producto', [ProductStatusController::class, 'store'])->name('admin.productos.estado.store');
    Route::get('/estados-producto/{idEstadoProducto}', [ProductStatusController::class, 'show'])->name('admin.productos.estado.show');
    Route::get('/estados-producto/{idEstadoProducto}/editar', [ProductStatusController::class, 'edit'])->name('admin.productos.estado.edit');
    Route::put('/estados-producto/{idEstadoProducto}', [ProductStatusController::class, 'update'])->name('admin.productos.estado.update');
    Route::delete('/estados-producto/{idEstadoProducto}', [ProductStatusController::class, 'destroy'])->name('admin.productos.estado.destroy');
});

Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/sexo-producto', [GenderProductController::class, 'index'])->name('admin.productos.sexo.index');
    Route::get('/sexo-producto/nuevo', [GenderProductController::class, 'create'])->name('admin.productos.sexo.create');
    Route::post('/sexo-producto', [GenderProductController::class, 'store'])->name('admin.productos.sexo.store');
    Route::get('/sexo-producto/{idSexoProducto}', [GenderProductController::class, 'show'])->name('admin.productos.sexo.show');
    Route::get('/sexo-producto/{idSexoProducto}/editar', [GenderProductController::class, 'edit'])->name('admin.productos.sexo.edit');
    Route::put('/sexo-producto/{idSexoProducto}', [GenderProductController::class, 'update'])->name('admin.productos.sexo.update');
    Route::delete('/sexo-producto/{idSexoProducto}', [GenderProductController::class, 'destroy'])->name('admin.productos.sexo.destroy');
});

Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/clases-producto', [ClassProductController::class, 'index'])->name('admin.productos.clase.index');
    Route::get('/clases-producto/nueva', [ClassProductController::class, 'create'])->name('admin.productos.clase.create');
    Route::post('/clases-producto', [ClassProductController::class, 'store'])->name('admin.productos.clase.store');
    Route::get('/clases-producto/{idClaseProducto}', [ClassProductController::class, 'show'])->name('admin.productos.clase.show');
    Route::get('/clases-producto/{idClaseProducto}/editar', [ClassProductController::class, 'edit'])->name('admin.productos.clase.edit');
    Route::put('/clases-producto/{idClaseProducto}', [ClassProductController::class, 'update'])->name('admin.productos.clase.update');
    Route::delete('/clases-producto/{idClaseProducto}', [ClassProductController::class, 'destroy'])->name('admin.productos.clase.destroy');
});

Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/colores', [ColorController::class, 'index'])->name('admin.productos.color.index');
    Route::get('/colores/nuevo', [ColorController::class, 'create'])->name('admin.productos.color.create');
    Route::post('/colores', [ColorController::class, 'store'])->name('admin.productos.color.store');
    Route::get('/colores/{idColor}', [ColorController::class, 'show'])->name('admin.productos.color.show');
    Route::get('/colores/{idColor}/editar', [ColorController::class, 'edit'])->name('admin.productos.color.edit');
    Route::put('/colores/{idColor}', [ColorController::class, 'update'])->name('admin.productos.color.update');
    Route::delete('/colores/{idColor}', [ColorController::class, 'destroy'])->name('admin.productos.color.destroy');
});

Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/ofertas/tipos', [OfferTypeController::class, 'index'])->name('admin.ofertas.tipo.index');
    Route::get('/ofertas/tipos/nuevo', [OfferTypeController::class, 'create'])->name('admin.ofertas.tipo.create');
    Route::post('/ofertas/tipos', [OfferTypeController::class, 'store'])->name('admin.ofertas.tipo.store');
    Route::get('/ofertas/tipos/{idTipoOferta}', [OfferTypeController::class, 'show'])->name('admin.ofertas.tipo.show');
    Route::get('/ofertas/tipos/{idTipoOferta}/editar', [OfferTypeController::class, 'edit'])->name('admin.ofertas.tipo.edit');
    Route::put('/ofertas/tipos/{idTipoOferta}', [OfferTypeController::class, 'update'])->name('admin.ofertas.tipo.update');
    Route::delete('/ofertas/tipos/{idTipoOferta}', [OfferTypeController::class, 'destroy'])->name('admin.ofertas.tipo.destroy');
});

Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/ofertas/estados', [OfferStatusController::class, 'index'])->name('admin.ofertas.estado.index');
    Route::get('/ofertas/estados/nuevo', [OfferStatusController::class, 'create'])->name('admin.ofertas.estado.create');
    Route::post('/ofertas/estados', [OfferStatusController::class, 'store'])->name('admin.ofertas.estado.store');
    Route::get('/ofertas/estados/{idEstadoOferta}', [OfferStatusController::class, 'show'])->name('admin.ofertas.estado.show');
    Route::get('/ofertas/estados/{idEstadoOferta}/editar', [OfferStatusController::class, 'edit'])->name('admin.ofertas.estado.edit');
    Route::put('/ofertas/estados/{idEstadoOferta}', [OfferStatusController::class, 'update'])->name('admin.ofertas.estado.update');
    Route::delete('/ofertas/estados/{idEstadoOferta}', [OfferStatusController::class, 'destroy'])->name('admin.ofertas.estado.destroy');
});
//manejo de ciudades
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/ciudades', [CityController::class, 'index'])->name('admin.ciudades.index');
    Route::get('/ciudades/nuevo', [CityController::class, 'create'])->name('admin.ciudades.create');
    Route::post('/ciudades', [CityController::class, 'store'])->name('admin.ciudades.store');
    Route::get('/ciudades/{id_ciudad}', [CityController::class, 'show'])->name('admin.ciudades.show');
    Route::get('/ciudades/{id_ciudad}/editar', [CityController::class, 'edit'])->name('admin.ciudades.edit');
    Route::put('/ciudades/{id_ciudad}', [CityController::class, 'update'])->name('admin.ciudades.update');
    Route::delete('/ciudades/{id_ciudad}', [CityController::class, 'destroy'])->name('admin.ciudades.destroy');
});



// manejod de productos
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/productos', [ProductController::class, 'index'])->name('admin.productos.index');
    Route::get('/productos/nuevo', [ProductController::class, 'create'])->name('admin.productos.create');
    Route::post('/productos', [ProductController::class, 'store'])->name('admin.productos.store');
    Route::get('/productos/{idProducto}', [ProductController::class, 'show'])->name('admin.productos.show');
    Route::get('/productos/{idProducto}/editar', [ProductController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/productos/{idProducto}', [ProductController::class, 'update'])->name('admin.productos.update');
    Route::delete('/productos/{idProducto}', [ProductController::class, 'destroy'])->name('admin.productos.destroy');
});

//manejo de clientes
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/clientes', [ClientController::class, 'index'])->name('admin.clientes.index');
    Route::get('/clientes/nuevo', [ClientController::class, 'create'])->name('admin.clientes.create');
    Route::post('/clientes', [ClientController::class, 'store'])->name('admin.clientes.store');
    Route::get('/clientes/{n_identificacion}', [ClientController::class, 'show'])->name('admin.clientes.show');
    Route::get('/clientes/{n_identificacion}/editar', [ClientController::class, 'edit'])->name('admin.clientes.edit');
    Route::put('/clientes/{n_identificacion}', [ClientController::class, 'update'])->name('admin.clientes.update');
    Route::delete('/clientes/{n_identificacion}', [ClientController::class, 'destroy'])->name('admin.clientes.destroy');
});

// manejo de administrador


Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/administradores', [AdministratorController::class, 'index'])->name('admin.administradores.index');
    Route::get('/administradores/nuevo', [AdministratorController::class, 'create'])->name('admin.administradores.create');
    Route::post('/administradores', [AdministratorController::class, 'store'])->name('admin.administradores.store');
    Route::get('/administradores/{id_administrador}', [AdministratorController::class, 'show'])->name('admin.administradores.show');
    Route::get('/administradores/{id_administrador}/editar', [AdministratorController::class, 'edit'])->name('admin.administradores.edit');
    Route::put('/administradores/{id_administrador}', [AdministratorController::class, 'update'])->name('admin.administradores.update');
    Route::delete('/administradores/{id_administrador}', [AdministratorController::class, 'destroy'])->name('admin.administradores.destroy');
});

//manejo de categorias
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/categorias', [CategoryController::class, 'index'])->name('admin.categorias.index');
    Route::get('/categorias/nueva', [CategoryController::class, 'create'])->name('admin.categorias.create');
    Route::post('/categorias', [CategoryController::class, 'store'])->name('admin.categorias.store');
    Route::get('/categorias/{id_categoria}', [CategoryController::class, 'show'])->name('admin.categorias.show');
    Route::get('/categorias/{id_categoria}/editar', [CategoryController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/categorias/{id_categoria}', [CategoryController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/categorias/{id_categoria}', [CategoryController::class, 'destroy'])->name('admin.categorias.destroy');
});



Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/categorias', [CategoryController::class, 'index'])->name('admin.categorias.index');
    Route::get('/categorias/nueva', [CategoryController::class, 'create'])->name('admin.categorias.create');
    Route::post('/categorias', [CategoryController::class, 'store'])->name('admin.categorias.store');
    Route::get('/categorias/{id_categoria}', [CategoryController::class, 'show'])->name('admin.categorias.show');
    Route::get('/categorias/{id_categoria}/editar', [CategoryController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/categorias/{id_categoria}', [CategoryController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/categorias/{id_categoria}', [CategoryController::class, 'destroy'])->name('admin.categorias.destroy');
});

//FINAL DE LAS RUTAS DE PARTE DEL ADMINSITRADOR 14 / 05 / 2025


Route::get('/', [NavController::class, 'index'])->name('productos');

//productos
Route::get('/productosall', [NavController::class, 'productos'])->name('productosall');
//perfil

Route::get('/mostrar', [NavController::class, 'mostrar'])->name('mostrar');
// modelos para probar las visas
Route::get('/foradmin', [visualizadorModelos::class, 'modelAdmin'])->name('foradmin');
route::get('/forclient', [visualizadorModelos::class, 'modelClient'])->name('forclient');


// Rutas para clientes
Route::get('/cliente/nuevo', [ClientController::class, 'create'])->name('client.create');
Route::post('/cliente', [ClientController::class, 'store'])->name('client.store');
Route::get('/cliente/{n_identificacion}', [ClientController::class, 'show'])->name('client.show');

// Route::post('/registro',[UseController::class,"regi"]);
Route::get('/sesion', [NavController::class, 'sesion'])->name('sesion');
// Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
// Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
// Route::post('/sesion', [AuthController::class, "login"])->name('loguear'); definir los metodos para loguear
// Route::post('/sesion', [NavController::class, "login"])->name('client.login');



Route::get('/listar', [ControllerUser::class, 'listar'])->name('listar');

Route::get('/eliminar-usuario/{id}', [ControllerUser::class, 'eliminar'])->name('eliminar.usuario');

Route::get('/p_nuevos', [NavController::class, 'p_nuevos'])->name('p_nuevos');

Route::get('/productosad', [ControllerUser::class, 'productosad'])->name('productosad');

Route::get('/eliminar-producto/{id}', [ControllerUser::class, 'eliminarp'])->name('eliminar.producto');


Route::get('/menulog', [NavController::class, 'menulog'])->name('menulog');

//ruta de la vista de los productos solos 
Route::get('/productonly', [NavController::class, 'productonly'])->name('productonly');
// perfil de usuaio

Route::get('/perfil', [NavController::class, 'perfil'])->name('perfil');
// Route::get('/perfil/compras', [NavController::class, 'perfil'])->name('perfil');
// Route::get('/perfil/actualizarInformacion', [NavController::class, 'perfil'])->name('perfil');


// fin de perfil de usuario
// rutas admin
Route::get('/administrador', [NavController::class, 'administrador'])->name('administrador');
Route::get('usuarios', [NavController::class, 'usuariosad'])->name('admin.usuarios');
Route::get('administracion', [NavController::class, 'administracion'])->name('admin.administracion');
Route::get('categorias', [NavController::class, 'categorias'])->name('admin.categorias');
//Route::get('pedidos', [NavController::class, 'pedidos'])->name('admin.pedidos');
Route::get('productos', [NavController::class, 'productosad'])->name('admin.productos');

//rutas admin 
/*
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::get('/administrador', [Admin::class, 'home'])->name('administrador');
    Route::get('/usuarios', [Admin::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/administracion', [Admin::class, 'administracion'])->name('admin.administracion');
    Route::get('/categorias', [Admin::class, 'categorias'])->name('admin.categorias');
    Route::get('/pedidos', [Admin::class, 'pedidos'])->name('admin.pedidos');
    Route::get('/productos', [Admin::class, 'productos'])->name('admin.productos');
});

Route::get('/login', [Admin::class, 'index'])->name('login');
Route::post('/validar', [Admin::class, 'validar']);
Route::post('/salir', [Admin::class, 'salir']);
*/


// categoria 
/*
use App\Http\Controllers\Admin\CategoriasController;

Route::middleware(['auth'])->group(function () {
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('admin.categorias');
    Route::get('/categorias/listar', [CategoriasController::class, 'listar']);
    Route::post('/categorias/registrar', [CategoriasController::class, 'registrar']);
    Route::delete('/categorias/delete/{idCat}', [CategoriasController::class, 'delete']);
    Route::get('/categorias/edit/{idCat}', [CategoriasController::class, 'edit']);
});*/

//para correos
/*
use App\Http\Controllers\ContactosController;

Route::post('/enviar-correo', [ContactosController::class, 'enviarCorreo']);*/


//rutas pedidos 

use App\Http\Controllers\Admin\PedidosController;

//Route::middleware(['auth'])->group(function () {
Route::get('/pedidos', [PedidosController::class, 'pedidos'])->name('admin.pedidos');
Route::get('pedidos/listarPedidos', [PedidosController::class, 'listarPedidos'])->name('pedidos.listarPedidos');
Route::get('pedidos/listarProceso', [PedidosController::class, 'listarProceso'])->name('pedidos.listarProceso');
Route::get('pedidos/listarFinalizados', [PedidosController::class, 'listarFinalizados'])->name('pedidos.listarFinalizados');
Route::post('pedidos/update/', [PedidosController::class, 'update'])->name('pedidos.update');
Route::get('/clientes/verPedido/{idPedido}', [PedidosController::class, 'verPedido'])->name('clientes.verPedido');
//});


// rutas productos 
/*
use App\Http\Controllers\Admin\ProductosController;

Route::middleware(['auth'])->group(function () {
    Route::get('/productos', [ProductosController::class, 'index'])->name('admin.productos');
    Route::get('/productos/listar', [ProductosController::class, 'listar']);
    Route::post('/productos/registrar', [ProductosController::class, 'registrar']);
    Route::delete('/productos/delete/{idPro}', [ProductosController::class, 'delete']);
    Route::get('/productos/edit/{idPro}', [ProductosController::class, 'edit']);
    Route::post('/productos/galeria', [ProductosController::class, 'galeriaImagenes']);
    Route::get('/productos/galeria/{id_producto}', [ProductosController::class, 'verGaleria']);
    Route::post('/productos/eliminar-imagen', [ProductosController::class, 'eliminarImg']);
});*/

//rutas usuario 
/*
use App\Http\Controllers\Admin\UsuariosController;

Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('admin.usuarios');
    Route::get('/usuarios/listar', [UsuariosController::class, 'listar']);
    Route::post('/usuarios/registrar', [UsuariosController::class, 'registrar']);
    Route::delete('/usuarios/delete/{idUser}', [UsuariosController::class, 'delete']);
    Route::get('/usuarios/edit/{idUser}', [UsuariosController::class, 'edit']);
});*/