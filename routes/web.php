<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\AdminRoleController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OfferByCategoryController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\CouponUsedController;
use App\Http\Controllers\admin\OrderController ;
use App\Http\Controllers\admin\SaleController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\ProductStatusController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\GenderProductController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\OfferStatusController;
use App\Http\Controllers\admin\OfferTypeController;
use App\Http\Controllers\admin\CartItemController;
use App\Http\Controllers\admin\FavoriteController;
use App\Http\Controllers\admin\ImageProductController;
use App\Http\Controllers\admin\ReturnProductController;
use App\Http\Controllers\admin\AdministratorController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\HistoryActionController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\facturaController;

use App\Http\Controllers\Webhook\PayUWebhookController;
use App\Http\Controllers\Webhook\MercadoPagoWebhookController;
use App\Http\Controllers\Webhook\PayPalWebhookController;
use App\Http\Controllers\admin\DashboardController;

use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\OrderController as ClientOrderController;
use App\Http\Controllers\client\MessageController as ClientMessageController;
use App\Http\Controllers\client\ReturnProductController as ClientReturnController;
use App\Http\Controllers\client\ClientFavoriteController;
use App\Http\Controllers\client\NotificationController as ClientNotificationController;
use App\Http\Controllers\client\HistoryActionController as ClientHistoryActionController;
use App\Http\Controllers\client\OfferController;
use App\Http\Controllers\client\auth\PasswordResetController;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all have the "web" middleware group.
|
*/
// routes/web.php

// ======================
// === RUTAS PÚBLICAS ===
// ======================

// Página principal – Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Búsqueda de productos – también pública
Route::get('/buscar', [HomeController::class, 'buscar']);

// Listado público de productos – AJAX
Route::get('/productos', [\App\Http\Controllers\ProductController::class, 'indexPublico'])->name('productos.publico.index');

// Detalle de producto – pública
Route::get('/producto/{idProducto}', [\App\Http\Controllers\ProductController::class, 'showPublico'])->name('productos.publico.show');

// Filtrar por marca – pública
Route::get('/marca/{id_marca}', [HomeController::class, 'productosPorMarca'])->name('home.marca');

// Filtrar por categoría – pública
Route::get('/categoria/{id_categoria}', [HomeController::class, 'productosPorCategoria'])->name('home.categoria');


// Productos públicos

// Ofertas públicas
Route::get('/ofertas', [OfferController::class, 'index'])->name('client.ofertas.index');
Route::get('/ofertas/categoria/{id_oferta_categoria}', [OfferController::class, 'showCategoria'])->name('client.ofertas.categoria.show');

// Ruta pública – Formulario de recuperar contraseña

Route::get('/cliente/recuperar-clave', [PasswordResetController::class, 'showEmailForm'])
    ->name('client.password.email');

Route::post('/cliente/recuperar-clave', [PasswordResetController::class, 'sendResetLink'])
    ->name('client.password.send');

Route::get('/cliente/resetear-clave/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('client.password.reset');

Route::post('/cliente/resetear-clave', [PasswordResetController::class, 'resetPassword'])
    ->name('client.password.update');
    
    // Login del cliente
    Route::get('/cliente/login', [\App\Http\Controllers\Client\Auth\ClientLoginController::class, 'showLoginForm'])->name('client.login');
    Route::post('/cliente/login', [\App\Http\Controllers\Client\Auth\ClientLoginController::class, 'login']);
Route::post('/cliente/logout', [\App\Http\Controllers\Client\Auth\ClientLoginController::class, 'logout'])->name('client.logout');

// Webhooks de pagos (públicos)
Route::post('/webhook/payu', [PayUWebhookController::class, 'handle'])->name('webhook.payu');
Route::post('/webhook/mercadopago', [MercadoPagoWebhookController::class, 'handle'])->name('webhook.mercadopago');
Route::post('/webhook/paypal', [PayPalWebhookController::class, 'handle'])->name('webhook.paypal');

// Página de inicio pública



Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Listado de productos público (AJAX)
Route::get('/productos', [ProductController::class, 'indexPublico'])->name('productos.publico.index');

// Detalle de producto público
Route::get('/producto/{idProducto}', [ProductController::class, 'showPublico'])->name('productos.publico.show');

// Rutas públicas – Cliente
// Ruta pública - Login del cliente
Route::get('/cliente/login', [\App\Http\Controllers\Client\Auth\ClientLoginController::class, 'showLoginForm'])
    ->name('client.login');

Route::post('/cliente/login', [\App\Http\Controllers\Client\Auth\ClientLoginController::class, 'login'])
    ->name('client.login.post');

Route::post('/cliente/logout', [\App\Http\Controllers\Client\Auth\ClientLoginController::class, 'logout'])
->name('client.logout');

    
// Registro de cliente
Route::get('/cliente/registro', [\App\Http\Controllers\Client\Auth\ClientRegisterController::class, 'showRegistrationForm'])
    ->name('client.register.form');

Route::post('/cliente/registro', [\App\Http\Controllers\Client\Auth\ClientRegisterController::class, 'store'])
    ->name('client.register');
// Archivo: routes/web.php
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // ... otras rutas admin ...
    
    // Rutas para clientes
    Route::prefix('clientes')->group(function() {
        Route::get('/', [ClientController::class, 'index'])->name('admin.clientes.index');
        Route::get('/crear', [ClientController::class, 'create'])->name('admin.clientes.create');
        Route::post('/', [ClientController::class, 'store'])->name('admin.clientes.store');
        Route::get('/{cliente}', [ClientController::class, 'show'])->name('admin.clientes.show');
        Route::get('/{cliente}/editar', [ClientController::class, 'edit'])->name('admin.clientes.edit');
        Route::put('/{cliente}', [ClientController::class, 'update'])->name('admin.clientes.update');
        Route::delete('/{cliente}', [ClientController::class, 'destroy'])->name('admin.clientes.destroy');


    });
    
    // ... otras rutas ...
});


    Route::prefix('admin')->middleware(['auth.admin'])->group(function() {
    // ... otras rutas admin ...
    
    // Rutas de perfil del administrador
    Route::prefix('perfil')->group(function() {
        Route::get('/', [\App\Http\Controllers\admin\ProfileController::class, 'index'])->name('admin.perfil.index');
        Route::get('/editar', [\App\Http\Controllers\admin\ProfileController::class, 'edit'])->name('admin.perfil.edit');
        Route::put('/actualizar', [\App\Http\Controllers\admin\ProfileController::class, 'update'])->name('admin.perfil.update');
    });
});

Route::prefix('cliente')->middleware('auth.client')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('client.checkout.index');
    Route::post('/checkout/metodo-pago', [CheckoutController::class, 'selectPayment'])->name('client.checkout.payment');
    Route::get('/checkout/{method}', [CheckoutController::class, 'confirm'])->name('client.checkout.confirm');
});


// '
Route::prefix('webhook')->group(function () {
    Route::post('/payu', [PayUWebhookController::class, 'handle'])->name('webhook.payu');
    Route::post('/mercadopago', [MercadoPagoWebhookController::class, 'handle'])->name('webhook.mercadopago');
    Route::post('/paypal', [PayPalWebhookController::class, 'handle'])->name('webhook.paypal');
});


// Rutas protegidas - Cliente autenticado
Route::prefix('cliente')->middleware('auth.client')->group(function () {
    // Dashboard y perfil


    // Reseñas
    Route::post('/resenas/guardar', [ ReviewController::class, 'store' ])->name('client.productos.resenas.store');

    // Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('client.dashboard');



    // Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::prefix('perfil')->group(function () {
            Route::get('/', [\App\Http\Controllers\Client\ProfileController::class, 'index'])->name('client.perfil.index');
            Route::get('/editar', [\App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('client.perfil.edit');
            Route::put('/editar', [\App\Http\Controllers\Client\ProfileController::class, 'update'])->name('client.perfil.update');
        
        // // Productos
        Route::get('/productos', [ ClientController::class, 'indexProductos' ])->name('client.productos.index');
        Route::get('/productos/{idProducto}', [ ClientController::class, 'showProducto' ])->name('client.productos.show');

        // Carrito
        Route::get('/carrito', [ CheckoutController::class, 'indexCarrito' ])->name('client.carrito.index');
        Route::post('/carrito/agregar/{idProducto}', [ CheckoutController::class, 'addToCart' ])->name('client.carrito.add');
        Route::delete('/carrito/eliminar/{id_carrito}', [ CheckoutController::class, 'removeFromCart' ])->name('client.carrito.remove');

        // Favoritos
        Route::get('/favoritos', [ ClientFavoriteController::class, 'index' ])->name('client.favoritos.index');
        Route::post('/favoritos/agregar', [ ClientFavoriteController::class, 'store' ])->name('client.favoritos.store');
        Route::delete('/favoritos/{id_favorito}', [ ClientFavoriteController::class, 'destroy' ])->name('client.favoritos.destroy');

        // Pedidos del cliente
        Route::prefix('mis-pedidos')->group(function () {
            Route::get('/', [ ClientOrderController::class, 'index' ])->name('client.pedidos.index');
            Route::get('/{id_pedido}', [ ClientOrderController::class, 'show' ])->name('client.pedidos.show');
        });
        // Mensajes de soporte
        Route::get('/mensajes', [ ClientMessageController::class, 'index' ])->name('client.mensajes.index');
        Route::get('/mensajes/nuevo', [ ClientMessageController::class, 'create' ])->name('client.mensajes.create');
        Route::post('/mensajes', [ ClientMessageController::class, 'store' ])->name('client.mensajes.store');
        Route::get('/mensajes/{id_mensaje}', [ ClientMessageController::class, 'show' ])->name('client.mensajes.show');

        // Devoluciones
        Route::prefix('devoluciones')->group(function () {
            Route::get('/', [ ClientReturnController::class, 'index' ])->name('client.devoluciones.index');
            Route::get('/nueva', [ ClientReturnController::class, 'create' ])->name('client.devoluciones.create');
            Route::post('/', [ ClientReturnController::class, 'store' ])->name('client.devoluciones.store');
            Route::get('/{id_devolucion}', [ ClientReturnController::class, 'show' ])->name('client.devoluciones.show');
            Route::delete('/{id_devolucion}', [ ClientReturnController::class, 'destroy' ])->name('client.devoluciones.destroy');
        });

        // Ofertas
        Route::get('/ofertas', [ OfferController::class, 'index' ])->name('client.ofertas.index');
        Route::get('/ofertas/categoria/{id_oferta_categoria}', [ OfferController::class, 'showCategoria' ])->name('client.ofertas.categoria.show');
    });
});

// Rutas públicas – Administrador
Route::get('admin/login', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'login'])-> name('admin.login.post');
Route::post('admin/logout', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

// Rutas protegidas - Administrador autenticado
Route::prefix('admin')->middleware(\App\Http\Middleware\AuthenticateAdmin::class)->group(function () {
        // dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Registro de administradores (solo accesible por SuperAdmin)
        Route::get('/administradores/nuevo', [\App\Http\Controllers\Admin\Auth\AdminRegisterController::class, 'showRegistrationForm'])->name('admin.administradores.create');
        Route::post('/administradores', [\App\Http\Controllers\Admin\Auth\AdminRegisterController::class, 'store'])->name('admin.administradores.store');

        
// Filtro por marca en web pública
    Route::get('/marca/{id_marca}', [HomeController::class, 'productosPorMarca'])->name('home.marca');

// CRUD de marcas (admin)

        Route::prefix('marcas')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.marcas.index');
            Route::get('/nueva', [BrandController::class, 'create'])->name('admin.marcas.create');
            Route::post('/', [BrandController::class, 'store'])->name('admin.marcas.store');
            Route::get('/{id_marca}', [BrandController::class, 'show'])->name('admin.marcas.show');
            Route::get('/{id_marca}/editar', [BrandController::class, 'edit'])->name('admin.marcas.edit');
            Route::put('/{id_marca}', [BrandController::class, 'update'])->name('admin.marcas.update');
            Route::delete('/{id_marca}', [BrandController::class, 'destroy'])->name('admin.marcas.destroy');
        });





    
    // Facturas
    Route::prefix('facturas')->group(function () {

        Route::get('/facturas/{id_venta}', [ InvoiceController::class, 'generate' ])->name('admin.facturas.generate');
        Route::get('/facturas/{id_venta}/ver', [ InvoiceController::class, 'show' ])->name('admin.facturas.show');
        Route::post('/facturas/webhook', [ InvoiceController::class, 'generateFromWebhook' ])->name('admin.facturas.webhook');
        Route::get('/facturas/{id_venta}/enviar', [ InvoiceController::class, 'sendToClient' ])->name('admin.facturas.send');
        Route::get('/facturas', [ InvoiceController::class, 'index' ])->name('admin.facturas.index');
        Route::get('/facturas/manual', [ InvoiceController::class, 'createManual' ])->name('admin.facturas.create.manual');
        Route::post('/facturas/manual', [ InvoiceController::class, 'storeManual' ])->name('admin.facturas.manual.store');
        Route::get('/facturas/{id_factura}', [ InvoiceController::class, 'show' ])->name('admin.facturas.show');
        Route::put('/facturas/anular/{id_factura}', [ InvoiceController::class, 'anular' ])->name('admin.facturas.anular');
        Route::get('/facturas/{id_factura}/imprimir', [ InvoiceController::class, 'print' ])->name('admin.facturas.print');
        Route::post('/generate/pedido/{pedido}', action: [ FacturaController::class, 'generateFromOrder' ])->name('admin.facturas.generate.pedido');

    });

    // Reportes
    Route::prefix('reportes')->group(function () {
        // Ventas
        Route::get('/ventas', [ReportController::class, 'indexVentas'])->name('admin.reportes.ventas.index');
        Route::get('/ventas/{id_venta}', [ReportController::class, 'detalleVenta'])->name('admin.reportes.ventas.show');
        // Inventario
        Route::get('/inventario', [ReportController::class, 'indexInventario'])->name('admin.reportes.inventario.index');
    });


    // reseñas
    Route::get('/reseñas', [ReviewController::class, 'index'])->name('admin.reseñas.index');
    Route::get('/reseñas/nueva', [ReviewController::class, 'create'])->name('admin.reseñas.create');
    Route::post('/reseñas', [ReviewController::class, 'store'])->name('admin.reseñas.store');
    Route::get('/reseñas/{id_reseña}', [ReviewController::class, 'show'])->name('admin.reseñas.show');
    Route::get('/reseñas/{id_reseña}/editar', [ReviewController::class, 'edit'])->name('admin.reseñas.edit');
    Route::put('/reseñas/{id_reseña}', [ReviewController::class, 'update'])->name('admin.reseñas.update');
    Route::delete('/reseñas/{id_reseña}', [ReviewController::class, 'destroy'])->name('admin.reseñas.destroy');

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

    // Generar factura

    Route::get('/ventas/{id_venta}/factura', [InvoiceController::class, 'generate'])->name('admin.reportes.ventas.invoice.generate');
    Route::get('/ventas/{id_venta}/factura/ver', [InvoiceController::class, 'show'])->name('admin.reportes.ventas.invoice.show');

    // Webhook de pagos
    Route::post('/webhook/payu', [PayUWebhookController::class, 'handle'])->name('webhook.payu');

    // Inventario
    Route::prefix('inventario')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventario.index');
        Route::get('/{id_inventario}/editar', [InventoryController::class, 'edit'])->name('admin.inventario.edit');
        Route::put('/{id_inventario}', [InventoryController::class, 'update'])->name('admin.inventario.update');
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

        // Usados
        Route::prefix('usados')->group(function () {
            Route::get('/', [CouponUsedController::class, 'index'])->name('admin.cupones.usados.index');
            Route::get('/nuevo', [CouponUsedController::class, 'create'])->name('admin.cupones.usados.create');
            Route::post('/', [CouponUsedController::class, 'store'])->name('admin.cupones.usados.store');
            Route::get('/{id_cupon_usado}', [CouponUsedController::class, 'show'])->name('admin.cupones.usados.show');
            Route::get('/{id_cupon_usado}/editar', [CouponUsedController::class, 'edit'])->name('admin.cupones.usados.edit');
            Route::put('/{id_cupon_usado}', [CouponUsedController::class, 'update'])->name('admin.cupones.usados.update');
            Route::delete('/{id_cupon_usado}', [CouponUsedController::class, 'destroy'])->name('admin.cupones.usados.destroy');
        });

     

        Route::prefix('mensajes-soporte')->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('admin.mensajes.index');
            Route::get('/nuevo', [MessageController::class, 'create'])->name('admin.mensajes.create');
            Route::post('/', [MessageController::class, 'store'])->name('admin.mensajes.store');
            Route::get('/{id_mensaje}', [MessageController::class, 'show'])->name('admin.mensajes.show');
            Route::get('/{id_mensaje}/editar', [MessageController::class, 'edit'])->name('admin.mensajes.edit');
            Route::put('/{id_mensaje}', [MessageController::class, 'update'])->name('admin.mensajes.update');
            Route::delete('/{id_mensaje}', [MessageController::class, 'destroy'])->name('admin.mensajes.destroy');
        });
    });

    // Ofertas por categoría
    Route::prefix('ofertas/categoria')->group(function () {
        Route::get('/', [OfferByCategoryController::class, 'index'])->name('admin.ofertas.categoria.index');
        Route::get('/nueva', [OfferByCategoryController::class, 'create'])->name('admin.ofertas.categoria.create');
        Route::post('/', [OfferByCategoryController::class, 'store'])->name('admin.ofertas.categoria.store');
        Route::get('/{id_oferta_categoria}', [OfferByCategoryController::class, 'show'])->name('admin.ofertas.categoria.show');
        Route::get('/{id_oferta_categoria}/editar', [OfferByCategoryController::class, 'edit'])->name('admin.ofertas.categoria.edit');
        Route::put('/{id_oferta_categoria}', [OfferByCategoryController::class, 'update'])->name('admin.ofertas.categoria.update');
        Route::delete('/{id_oferta_categoria}', [OfferByCategoryController::class, 'destroy'])->name('admin.ofertas.categoria.destroy');
    });

    // Imágenes de productos
    Route::prefix('imagenes')->group(function () {
        Route::get('/{idProducto}', [ImageProductController::class, 'index'])->name('admin.productos.imagenes.index');
        Route::get('/{idProducto}/nueva', [ImageProductController::class, 'create'])->name('admin.productos.imagenes.create');
        Route::post('/{idProducto}', [ImageProductController::class, 'store'])->name('admin.productos.imagenes.store');
        Route::get('/{idProducto}/{id_imagen}', [ImageProductController::class, 'show'])->name('admin.productos.imagenes.show');
        Route::get('/{idProducto}/{id_imagen}/editar', [ImageProductController::class, 'edit'])->name('admin.productos.imagenes.edit');
        Route::put('/{idProducto}/{id_imagen}', [ImageProductController::class, 'update'])->name('admin.productos.imagenes.update');
        Route::delete('/{idProducto}/{id_imagen}', [ImageProductController::class, 'destroy'])->name('admin.productos.imagenes.destroy');
    });

    // Pedidos del admin


    // Ventas
    Route::prefix('ventas')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('admin.ventas.index');
        Route::get('/{id_venta}', [SaleController::class, 'show'])->name('admin.ventas.show');
    });

    // Departamentos
    Route::prefix('departamentos')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.departamentos.index');
        Route::get('/{id_departamento}', [DepartmentController::class, 'show'])->name('admin.departamentos.show');
        Route::get('/nuevo', [DepartmentController::class, 'create'])->name('admin.departamentos.create');
        Route::post('/', [DepartmentController::class, 'store'])->name('admin.departamentos.store');
        Route::get('/{id_departamento}/editar', [DepartmentController::class, 'edit'])->name('admin.departamentos.edit');
        Route::put('/{id_departamento}', [DepartmentController::class, 'update'])->name('admin.departamentos.update');
        Route::delete('/{id_departamento}', [DepartmentController::class, 'destroy'])->name('admin.departamentos.destroy');
    });

    // Ciudades
    Route::prefix('ciudades')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('admin.ciudades.index');
        Route::get('/nueva', [CityController::class, 'create'])->name('admin.ciudades.create');
        Route::post('/', [CityController::class, 'store'])->name('admin.ciudades.store');
        Route::get('/{id_ciudad}', [CityController::class, 'show'])->name('admin.ciudades.show');
        Route::get('/{id_ciudad}/editar', [CityController::class, 'edit'])->name('admin.ciudades.edit');
        Route::put('/{id_ciudad}', [CityController::class, 'update'])->name('admin.ciudades.update');
        Route::delete('/{id_ciudad}', [CityController::class, 'destroy'])->name('admin.ciudades.destroy');
    });

    // Estados del producto
    Route::prefix('estados-producto')->group(function () {
        Route::get('/', [ProductStatusController::class, 'index'])->name('admin.productos.estado.index');
        Route::get('/nuevo', [ProductStatusController::class, 'create'])->name('admin.productos.estado.create');
        Route::post('/', [ProductStatusController::class, 'store'])->name('admin.productos.estado.store');
        Route::get('/{idEstadoOferta}', [ProductStatusController::class, 'show'])->name('admin.productos.estado.show');
        Route::get('/{idEstadoOferta}/editar', [ProductStatusController::class, 'edit'])->name('admin.productos.estado.edit');
        Route::put('/{idEstadoOferta}', [ProductStatusController::class, 'update'])->name('admin.productos.estado.update');
        Route::delete('/{idEstadoOferta}', [ProductStatusController::class, 'destroy'])->name('admin.productos.estado.destroy');
    });
    

    // Tipos de oferta
    Route::prefix('ofertas/tipos')->group(function () {
        Route::get('/', [OfferTypeController::class, 'index'])->name('admin.ofertas.tipo.index');
        Route::get('/nuevo', [OfferTypeController::class, 'create'])->name('admin.ofertas.tipo.create');
        Route::post('/', [OfferTypeController::class, 'store'])->name('admin.ofertas.tipo.store');
        Route::get('/{idTipoOferta}', [OfferTypeController::class, 'show'])->name('admin.ofertas.tipo.show');
        Route::get('/{idTipoOferta}/editar', [OfferTypeController::class, 'edit'])->name('admin.ofertas.tipo.edit');
        Route::put('/{idTipoOferta}', [OfferTypeController::class, 'update'])->name('admin.ofertas.tipo.update');
        Route::delete('/{idTipoOferta}', [OfferTypeController::class, 'destroy'])->name('admin.ofertas.tipo.destroy');
    });

    // Colores
    Route::prefix('colores')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('admin.productos.color.index');
        Route::get('/nuevo', [ColorController::class, 'create'])->name('admin.productos.color.create');
        Route::post('/', [ColorController::class, 'store'])->name('admin.productos.color.store');
        Route::get('/{idColor}', [ColorController::class, 'show'])->name('admin.productos.color.show');
        Route::get('/{idColor}/editar', [ColorController::class, 'edit'])->name('admin.productos.color.edit');
        Route::put('/{idColor}', [ColorController::class, 'update'])->name('admin.productos.color.update');
        Route::delete('/{idColor}', [ColorController::class, 'destroy'])->name('admin.productos.color.destroy');
    });

    // Género del producto
    Route::prefix('sexos-producto')->group(function () {
        Route::get('/', [GenderProductController::class, 'index'])->name('admin.productos.sexo.index');
        Route::get('/nuevo', [GenderProductController::class, 'create'])->name('admin.productos.sexo.create');
        Route::post('/', [GenderProductController::class, 'store'])->name('admin.productos.sexo.store');
        Route::get('/{idSexoProducto}', [GenderProductController::class, 'show'])->name('admin.productos.sexo.show');
        Route::get('/{idSexoProducto}/editar', [GenderProductController::class, 'edit'])->name('admin.productos.sexo.edit');
        Route::put('/{idSexoProducto}', [GenderProductController::class, 'update'])->name('admin.productos.sexo.update');
        Route::delete('/{idSexoProducto}', [GenderProductController::class, 'destroy'])->name('admin.productos.sexo.destroy');
    });

    // Tallas
    Route::prefix('tallas')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('admin.tallas.index');
        Route::get('/nueva', [SizeController::class, 'create'])->name('admin.tallas.create');
        Route::post('/', [SizeController::class, 'store'])->name('admin.tallas.store');
        Route::get('/{id_talla}', [SizeController::class, 'show'])->name('admin.tallas.show');
        Route::get('/{id_talla}/editar', [SizeController::class, 'edit'])->name('admin.tallas.edit');
        Route::put('/{id_talla}', [SizeController::class, 'update'])->name('admin.tallas.update');
        Route::delete('/{id_talla}', [SizeController::class, 'destroy'])->name('admin.tallas.destroy');
    });

    // Facturas
    Route::prefix('facturas')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('admin.facturas.index');
        Route::get('/manual', [InvoiceController::class, 'createManual'])->name('admin.facturas.create.manual');
        Route::post('/manual', [InvoiceController::class, 'storeManual'])->name('admin.facturas.manual.store');
        Route::get('/{id_factura}', [InvoiceController::class, 'show'])->name('admin.facturas.show');
        Route::put('/{id_factura}', [InvoiceController::class, 'update'])->name('admin.facturas.update');
    });

    // Historial de acciones
    Route::prefix('historial-acciones')->group(function () {
        Route::get('/', [HistoryActionController::class, 'index'])->name('admin.historial.index');
        Route::get('/{id_registro}', [HistoryActionController::class, 'show'])->name('admin.historial.show');
        Route::delete('/{id_registro}', [HistoryActionController::class, 'destroy'])->name('admin.historial.destroy');
    });

    // Notificaciones del admin
    Route::prefix('notificaciones')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('admin.notificaciones.index');
        Route::get('/{id_notificacion}', [NotificationController::class, 'show'])->name('admin.notificaciones.show');
        Route::delete('/{id_notificacion}', [NotificationController::class, 'destroy'])->name('admin.notificaciones.destroy');
    });

    // Carrito desde el admin (opcional)
    Route::prefix('carrito')->group(function () {
        Route::get('/', [CartItemController::class, 'index'])->name('admin.carrito.index');
        Route::delete('/{id_carrito}', [CartItemController::class, 'destroy'])->name('admin.carrito.destroy');
    });

    // Favoritos desde el admin
    Route::prefix('favoritos')->group(function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('admin.favoritos.index');
        Route::delete('/{id_favorito}', [FavoriteController::class, 'destroy'])->name('admin.favoritos.destroy');
    });


    // Devoluciones desde el admin
    Route::prefix('devoluciones')->group(function () {
        Route::get('/', [ReturnProductController::class, 'index'])->name('admin.devoluciones.index');
        Route::get('/{id_devolucion}', [ReturnProductController::class, 'show'])->name('admin.devoluciones.show');
        Route::delete('/{id_devolucion}', [ReturnProductController::class, 'destroy'])->name('admin.devoluciones.destroy');
    });

Route::prefix('pedidos')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.pedidos.index');
    Route::get('/crear', [OrderController::class, 'create'])->name('admin.pedidos.create');
    Route::post('/', [OrderController::class, 'store'])->name('admin.pedidos.store');
    Route::get('/{pedido}', [OrderController::class, 'show'])->name('admin.pedidos.show');
    Route::get('/{pedido}/editar', [OrderController::class, 'edit'])->name('admin.pedidos.edit');
    Route::put('/{pedido}', [OrderController::class, 'update'])->name('admin.pedidos.update');
    Route::delete('/{pedido}', [OrderController::class, 'destroy'])->name('admin.pedidos.destroy');
});

    // Administradores
    Route::prefix('administradores')->group(function () {
        Route::get('/', [AdministratorController::class, 'index'])->name('admin.administradores.index');
        Route::get('/nuevo', [AdministratorController::class, 'create'])->name('admin.administradores.create');
        Route::post('/', [AdministratorController::class, 'store'])->name('admin.administradores.store');
        Route::get('/{id_administrador}', [AdministratorController::class, 'show'])->name('admin.administradores.show');
        Route::get('/{id_administrador}/editar', [AdministratorController::class, 'edit'])->name('admin.administradores.edit');
        Route::put('/{id_administrador}', [AdministratorController::class, 'update'])->name('admin.administradores.update');
        Route::delete('/{id_administrador}', [AdministratorController::class, 'destroy'])->name('admin.administradores.destroy');
    });

    // Roles del administrador
    Route::prefix('roles-admin')->group(function () {
        Route::get('/', [AdminRoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/nuevo', [AdminRoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/', [AdminRoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/{id_rol_admin}', [AdminRoleController::class, 'show'])->name('admin.roles.show');
        Route::get('/{id_rol_admin}/editar', [AdminRoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{id_rol_admin}', [AdminRoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/{id_rol_admin}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy');

        // metodos de pago
        

});


});

Route::prefix('admin/metodos_pago')->middleware('auth.admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'index'])->name('admin.metodos_pago.index');
    Route::get('/nuevo', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'create'])->name('admin.metodos_pago.create');
    Route::post('/', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'store'])->name('admin.metodos_pago.store');
    Route::get('/{id_metodo_pago}', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'show'])->name('admin.metodos_pago.show');
    Route::get('/{id_metodo_pago}/editar', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'edit'])->name('admin.metodos_pago.edit');
    Route::put('/{id_metodo_pago}', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'update'])->name('admin.metodos_pago.update');
    Route::delete('/{id_metodo_pago}', [\App\Http\Controllers\Admin\PaymentMethodController::class, 'destroy'])->name('admin.metodos_pago.destroy');
});
?>
