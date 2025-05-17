<?php
// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Support\Facades\Route;

//#region Rutas del Administrador

// iniciador creadas el dia 14 /  05 2025
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

// #region Rutas del Cliente

// iniciador cradas 15 / 05 2025

use App\Http\Controllers\client\CartController;

use App\Http\Controllers\client\FavoriteController;

use App\Http\Controllers\client\NotificationController;

use App\Http\Controllers\client\HistoryActionController;


// finalizacion de runtas de clientes
// endregion

// RUTAS DEL CLIENTE


use App\Http\Controllers\admin\Admin;
use App\Http\Controllers\ControllerUser;
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


Route::get('/cliente/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('/cliente/login', [ClientLoginController::class, 'login']);
Route::post('/cliente/logout', [ClientLoginController::class, 'logout'])->name('client.logout');
// rutas protegidas del cliente

// Rutas protegidas – Cliente autenticado
Route::prefix('cliente')->middleware('auth.client')->group(function () {
    // Perfil del cliente
    Route::get('/perfil', [ClientController::class, 'show'])->name('client.perfil.show');
    Route::get('/perfil/editar', [ClientController::class, 'edit'])->name('client.perfil.edit');
    Route::put('/perfil', [ClientController::class, 'update'])->name('client.perfil.update');

    // Carrito
    Route::prefix('carrito')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('client.carrito.index');
        Route::post('/agregar', [CartController::class, 'store'])->name('client.carrito.store');
        Route::delete('/{id_carrito}', [CartController::class, 'destroy'])->name('client.carrito.destroy');
    });

    // Favoritos
    Route::prefix('favoritos')->group(function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('client.favoritos.index');
        Route::post('/agregar', [FavoriteController::class, 'store'])->name('client.favoritos.store');
        Route::delete('/{id_favorito}', [FavoriteController::class, 'destroy'])->name('client.favoritos.destroy');
    });

    // Notificaciones del cliente
    Route::prefix('notificaciones')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('client.notificaciones.index');
        Route::put('/{id_notificacion}/leer', [NotificationController::class, 'update'])->name('client.notificaciones.update');
        Route::delete('/{id_notificacion}', [NotificationController::class, 'destroy'])->name('client.notificaciones.destroy');
    });

    // Historial de acciones del cliente
    Route::prefix('historial-acciones')->group(function () {
        Route::get('/', [HistoryActionController::class, 'index'])->name('client.historial.index');
        Route::get('/{id_registro}', [HistoryActionController::class, 'show'])->name('client.historial.show');
        Route::delete('/{id_registro}', [HistoryActionController::class, 'destroy'])->name('client.historial.destroy');
    });

    // Mensajes al soporte
    Route::prefix('mensajes-soporte')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('client.mensajes.index');
        Route::get('/nuevo', [MessageController::class, 'create'])->name('client.mensajes.create');
        Route::post('/', [MessageController::class, 'store'])->name('client.mensajes.store');
        Route::get('/{id_mensaje}', [MessageController::class, 'show'])->name('client.mensajes.show');
    });

    // Devoluciones
    Route::prefix('devoluciones')->group(function () {
        Route::get('/', [ReturnProductController::class, 'index'])->name('client.devoluciones.index');
        Route::get('/nueva', [ReturnProductController::class, 'create'])->name('client.devoluciones.create');
        Route::post('/', [ReturnProductController::class, 'store'])->name('client.devoluciones.store');
        Route::get('/{id_devolucion}', [ReturnProductController::class, 'show'])->name('client.devoluciones.show');
        Route::delete('/{id_devolucion}', [ReturnProductController::class, 'destroy'])->name('client.devoluciones.destroy');
    });

    // Pedidos del cliente
    Route::prefix('mis-pedidos')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('client.pedidos.index');
        Route::get('/{id_pedido}', [OrderController::class, 'show'])->name('client.pedidos.show');
        Route::put('/{id_pedido}/cancelar', [OrderController::class, 'update'])->name('client.pedidos.update');
    });
});
// final  de las cutas del cliente
// endregion

// #region rutas del administrador`
// DEFINICION DE LAS RUNTAS DE PARTE DEL ADMINISTRADOR
// Rutas públicas para login
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


// rutas protegidas del administrador

// Rutas protegidas para administrador
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Productos
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.productos.index');
        Route::get('/nuevo', [ProductController::class, 'create'])->name('admin.productos.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.productos.store');
        Route::get('/{idProducto}', [ProductController::class, 'show'])->name('admin.productos.show');
        Route::get('/{idProducto}/editar', [ProductController::class, 'edit'])->name('admin.productos.edit');
        Route::put('/{idProducto}', [ProductController::class, 'update'])->name('admin.productos.update');
        Route::delete('/{idProducto}', [ProductController::class, 'destroy'])->name('admin.productos.destroy');
    });

    // Categorías
    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categorias.index');
        Route::get('/nueva', [CategoryController::class, 'create'])->name('admin.categorias.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categorias.store');
        Route::get('/{id_categoria}', [CategoryController::class, 'show'])->name('admin.categorias.show');
        Route::get('/{id_categoria}/editar', [CategoryController::class, 'edit'])->name('admin.categorias.edit');
        Route::put('/{id_categoria}', [CategoryController::class, 'update'])->name('admin.categorias.update');
        Route::delete('/{id_categoria}', [CategoryController::class, 'destroy'])->name('admin.categorias.destroy');
    });

    // Clientes
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('admin.clientes.index');
        Route::get('/{n_identificacion_cliente}', [ClientController::class, 'show'])->name('admin.clientes.show');
        Route::get('/{n_identificacion_cliente}/editar', [ClientController::class, 'edit'])->name('admin.clientes.edit');
        Route::put('/{n_identificacion_cliente}', [ClientController::class, 'update'])->name('admin.clientes.update');
        Route::delete('/{n_identificacion_cliente}', [ClientController::class, 'destroy'])->name('admin.clientes.destroy');
    });

    // Cupones
    Route::prefix('cupones')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('admin.cupones.index');
        Route::get('/nuevo', [CouponController::class, 'create'])->name('admin.cupones.create');
        Route::post('/', [CouponController::class, 'store'])->name('admin.cupones.store');
        Route::get('/{id_cupon}', [CouponController::class, 'show'])->name('admin.cupones.show');
        Route::get('/{id_cupon}/editar', [CouponController::class, 'edit'])->name('admin.cupones.edit');
        Route::put('/{id_cupon}', [CouponController::class, 'update'])->name('admin.cupones.update');
        Route::delete('/{id_cupon}', [CouponController::class, 'destroy'])->name('admin.cupones.destroy');

        // Cupones usados
        Route::prefix('usados')->group(function () {
            Route::get('/', [CuponesUsadosController::class, 'index'])->name('admin.cupones.usados.index');
            Route::get('/{id_cupon_usado}', [CuponesUsadosController::class, 'show'])->name('admin.cupones.usados.show');
            Route::get('/{id_cupon_usado}/editar', [CuponesUsadosController::class, 'edit'])->name('admin.cupones.usados.edit');
            Route::put('/{id_cupon_usado}', [CuponesUsadosController::class, 'update'])->name('admin.cupones.usados.update');
            Route::delete('/{id_cupon_usado}', [CuponesUsadosController::class, 'destroy'])->name('admin.cupones.usados.destroy');
        });
    });

    // Ofertas por categoría
    Route::prefix('ofertas/categoria')->group(function () {
        Route::get('/', [OfertasPorCategoriaController::class, 'index'])->name('admin.ofertas.categoria.index');
        Route::get('/nueva', [OfertasPorCategoriaController::class, 'create'])->name('admin.ofertas.categoria.create');
        Route::post('/', [OfertasPorCategoriaController::class, 'store'])->name('admin.ofertas.categoria.store');
        Route::get('/{id_oferta_categoria}', [OfertasPorCategoriaController::class, 'show'])->name('admin.ofertas.categoria.show');
        Route::get('/{id_oferta_categoria}/editar', [OfertasPorCategoriaController::class, 'edit'])->name('admin.ofertas.categoria.edit');
        Route::put('/{id_oferta_categoria}', [OfertasPorCategoriaController::class, 'update'])->name('admin.ofertas.categoria.update');
        Route::delete('/{id_oferta_categoria}', [OfertasPorCategoriaController::class, 'destroy'])->name('admin.ofertas.categoria.destroy');
    });

    // Historial de precios
    Route::prefix('historial-precios')->group(function () {
        Route::get('/', [HistorialPreciosController::class, 'index'])->name('admin.historial-precios.index');
        Route::get('/nuevo', [HistorialPreciosController::class, 'create'])->name('admin.historial-precios.create');
        Route::post('/', [HistorialPreciosController::class, 'store'])->name('admin.historial-precios.store');
        Route::get('/{id_historial}', [HistorialPreciosController::class, 'show'])->name('admin.historial-precios.show');
        Route::get('/{id_historial}/editar', [HistorialPreciosController::class, 'edit'])->name('admin.historial-precios.edit');
        Route::put('/{id_historial}', [HistorialPreciosController::class, 'update'])->name('admin.historial-precios.update');
        Route::delete('/{id_historial}', [HistorialPreciosController::class, 'destroy'])->name('admin.historial-precios.destroy');
    });

    // Inventario
    Route::prefix('inventario')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventario.index');
        Route::get('/nuevo', [InventoryController::class, 'create'])->name('admin.inventario.create');
        Route::post('/', [InventoryController::class, 'store'])->name('admin.inventario.store');
        Route::get('/{id_inventario}', [InventoryController::class, 'show'])->name('admin.inventario.show');
        Route::get('/{id_inventario}/editar', [InventoryController::class, 'edit'])->name('admin.inventario.edit');
        Route::put('/{id_inventario}', [InventoryController::class, 'update'])->name('admin.inventario.update');
        Route::delete('/{id_inventario}', [InventoryController::class, 'destroy'])->name('admin.inventario.destroy');
    });

    // Mensajes al soporte (admin)
    Route::prefix('mensajes-soporte')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('admin.mensajes.index');
        Route::get('/{id_mensaje}', [MessageController::class, 'show'])->name('admin.mensajes.show');
        Route::get('/{id_mensaje}/responder', [MessageController::class, 'edit'])->name('admin.mensajes.edit');
        Route::put('/{id_mensaje}', [MessageController::class, 'update'])->name('admin.mensajes.update');
        Route::delete('/{id_mensaje}', [MessageController::class, 'destroy'])->name('admin.mensajes.destroy');
    });

    // Devoluciones
    Route::prefix('devoluciones')->group(function () {
        Route::get('/', [ReturnProductController::class, 'index'])->name('admin.devoluciones.index');
        Route::get('/{id_devolucion}', [ReturnProductController::class, 'show'])->name('admin.devoluciones.show');
        Route::put('/{id_devolucion}', [ReturnProductController::class, 'update'])->name('admin.devoluciones.update');
        Route::delete('/{id_devolucion}', [ReturnProductController::class, 'destroy'])->name('admin.devoluciones.destroy');
    });

    // Pedidos
    Route::prefix('pedidos')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.pedidos.index');
        Route::get('/{id_pedido}', [OrderController::class, 'show'])->name('admin.pedidos.show');
        Route::get('/{id_pedido}/editar', [OrderController::class, 'edit'])->name('admin.pedidos.edit');
        Route::put('/{id_pedido}', [OrderController::class, 'update'])->name('admin.pedidos.update');
        Route::delete('/{id_pedido}', [OrderController::class, 'destroy'])->name('admin.pedidos.destroy');
    });

    // Ventas
    Route::prefix('ventas')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('admin.ventas.index');
        Route::get('/{id_venta}', [SaleController::class, 'show'])->name('admin.ventas.show');
        Route::get('/{id_venta}/editar', [SaleController::class, 'edit'])->name('admin.ventas.edit');
        Route::put('/{id_venta}', [SaleController::class, 'update'])->name('admin.ventas.update');
        Route::delete('/{id_venta}', [SaleController::class, 'destroy'])->name('admin.ventas.destroy');
    });

    // Departamentos y ciudades
    Route::prefix('departamentos')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.departamentos.index');
        Route::get('/{id_departamento}', [DepartmentController::class, 'show'])->name('admin.departamentos.show');
        Route::post('/', [DepartmentController::class, 'store'])->name('admin.departamentos.store');
        Route::put('/{id_departamento}', [DepartmentController::class, 'update'])->name('admin.departamentos.update');
        Route::delete('/{id_departamento}', [DepartmentController::class, 'destroy'])->name('admin.departamentos.destroy');
    });

    // Ciudades
    Route::prefix('ciudades')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('admin.ciudades.index');
        Route::get('/{id_ciudad}', [CityController::class, 'show'])->name('admin.ciudades.show');
        Route::post('/', [CityController::class, 'store'])->name('admin.ciudades.store');
        Route::put('/{id_ciudad}', [CityController::class, 'update'])->name('admin.ciudades.update');
        Route::delete('/{id_ciudad}', [CityController::class, 'destroy'])->name('admin.ciudades.destroy');
    });

    // Estados del producto
    Route::prefix('estados-producto')->group(function () {
        Route::get('/', [ProductStatusController::class, 'index'])->name('admin.productos.estado.index');
        Route::get('/nuevo', [ProductStatusController::class, 'create'])->name('admin.productos.estado.create');
        Route::post('/', [ProductStatusController::class, 'store'])->name('admin.productos.estado.store');
        Route::get('/{id_estado_producto}', [ProductStatusController::class, 'show'])->name('admin.productos.estado.show');
        Route::get('/{id_estado_producto}/editar', [ProductStatusController::class, 'edit'])->name('admin.productos.estado.edit');
        Route::put('/{id_estado_producto}', [ProductStatusController::class, 'update'])->name('admin.productos.estado.update');
        Route::delete('/{id_estado_producto}', [ProductStatusController::class, 'destroy'])->name('admin.productos.estado.destroy');
    });

    // Tipos de oferta
    Route::prefix('ofertas/estado')->group(function () {
        Route::get('/', [OfferStatusController::class, 'index'])->name('admin.ofertas.estado.index');
        Route::get('/nuevo', [OfferStatusController::class, 'create'])->name('admin.ofertas.estado.create');
        Route::post('/', [OfferStatusController::class, 'store'])->name('admin.ofertas.estado.store');
        Route::get('/{idEstadoOferta}', [OfferStatusController::class, 'show'])->name('admin.ofertas.estado.show');
        Route::get('/{idEstadoOferta}/editar', [OfferStatusController::class, 'edit'])->name('admin.ofertas.estado.edit');
        Route::put('/{idEstadoOferta}', [OfferStatusController::class, 'update'])->name('admin.ofertas.estado.update');
        Route::delete('/{idEstadoOferta}', [OfferStatusController::class, 'destroy'])->name('admin.ofertas.estado.destroy');
    });

    // Clases de producto
    Route::prefix('clases-producto')->group(function () {
        Route::get('/', [ClassProductController::class, 'index'])->name('admin.productos.clase.index');
        Route::get('/nuevo', [ClassProductController::class, 'create'])->name('admin.productos.clase.create');
        Route::post('/', [ClassProductController::class, 'store'])->name('admin.productos.clase.store');
        Route::get('/{idClaseProducto}', [ClassProductController::class, 'show'])->name('admin.productos.clase.show');
        Route::get('/{idClaseProducto}/editar', [ClassProductController::class, 'edit'])->name('admin.productos.clase.edit');
        Route::put('/{idClaseProducto}', [ClassProductController::class, 'update'])->name('admin.productos.clase.update');
        Route::delete('/{idClaseProducto}', [ClassProductController::class, 'destroy'])->name('admin.productos.clase.destroy');
    });

    // Colores de producto
    Route::prefix('colores')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('admin.productos.color.index');
        Route::get('/nuevo', [ColorController::class, 'create'])->name('admin.productos.color.create');
        Route::post('/', [ColorController::class, 'store'])->name('admin.productos.color.store');
        Route::get('/{idColor}', [ColorController::class, 'show'])->name('admin.productos.color.show');
        Route::get('/{idColor}/editar', [ColorController::class, 'edit'])->name('admin.productos.color.edit');
        Route::put('/{idColor}', [ColorController::class, 'update'])->name('admin.productos.color.update');
        Route::delete('/{idColor}', [ColorController::class, 'destroy'])->name('admin.productos.color.destroy');
    });

    // Roles de administrador
    Route::prefix('roles-administrador')->group(function () {
        Route::get('/', [AdminRoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/nuevo', [AdminRoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/', [AdminRoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/{id_rol_admin}', [AdminRoleController::class, 'show'])->name('admin.roles.show');
        Route::get('/{id_rol_admin}/editar', [AdminRoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{id_rol_admin}', [AdminRoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/{id_rol_admin}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy');
    });
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