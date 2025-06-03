-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2025 a las 14:31:02
-- Versión del servidor: 11.8.0-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aaa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_administrador` int(11) NOT NULL COMMENT 'ID único del administrador',
  `nombres` varchar(50) NOT NULL COMMENT 'Nombres del administrador',
  `apellidos` varchar(50) NOT NULL COMMENT 'Apellidos del administrador',
  `correoE` varchar(150) NOT NULL COMMENT 'Correo electrónico del administrador',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada con hash',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro del administrador',
  `estado_administrador` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = activo, 0 = inactivo',
  `id_rol_admin` int(11) NOT NULL COMMENT 'ID del rol del administrador',
  `n_identificacion` varchar(10) NOT NULL COMMENT 'Número de identificación del administrador',
  `intentos_fallidos_login` int(11) NOT NULL DEFAULT 0 COMMENT 'Número de intentos fallidos de inicio de sesión'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `nombres`, `apellidos`, `correoE`, `password`, `fecha_registro`, `estado_administrador`, `id_rol_admin`, `n_identificacion`, `intentos_fallidos_login`) VALUES
(1, 'Carlos', 'Gómez', 'carlos@example.com', '$2y$10$ejemplohash1', '2025-05-14 22:08:14', 1, 1, '1001', 0),
(2, 'Laura', 'Pérez', 'laura@example.com', '$2y$10$ejemplohash2', '2025-05-14 22:08:14', 1, 2, '1002', 0),
(4, '0', 'admin total', 'admin@admin.com', 'admin123', '2025-05-26 20:32:41', 1, 1, '1077480906', 0),
(5, 'Prueba', 'Sistema', 'adminis@adminis.com', '$2y$12$4yY8d2bxSZy7RIaJKQ3ddu8aUIZ5l.oPyRXYxYnSggeoHOq15xS2G', '2025-05-26 20:42:10', 1, 1, 'ADMIN001', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `id_talla` int(11) DEFAULT NULL COMMENT 'Talla seleccionada',
  `id_color` int(11) DEFAULT NULL COMMENT 'Color seleccionado',
  `cantidad` int(11) NOT NULL,
  `fecha_agregado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE `categorias_productos` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_productos`
--

INSERT INTO `categorias_productos` (`id_categoria`, `nombre_categoria`, `descripcion`) VALUES
(1, 'Camisetas', NULL),
(2, 'Pantalones', NULL),
(3, 'Zapatos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(50) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `nombre_ciudad`, `id_departamento`, `estado`) VALUES
(1, 'Medellín', 1, 1),
(2, 'Bogotá', 2, 1),
(3, 'Chía', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claseproducto`
--

CREATE TABLE `claseproducto` (
  `idClaseProducto` int(11) NOT NULL,
  `nombreClase` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `claseproducto`
--

INSERT INTO `claseproducto` (`idClaseProducto`, `nombreClase`) VALUES
(1, 'Ropa'),
(2, 'Calzado'),
(3, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `nombres` varchar(50) NOT NULL COMMENT 'Asegúrese que sea el nombre que aparece en su identificación',
  `apellidos` varchar(50) NOT NULL COMMENT 'Asegúrese que sean los apellidos de su identificación',
  `tipo_identificacion` enum('Cedula de ciudadania (CC)','Tarjeta de identidad (TI)','NIT','') NOT NULL DEFAULT 'Cedula de ciudadania (CC)' COMMENT 'Selección del tipo de identificación de su documento nacional: CC, TI, CE, NIT, etc.',
  `n_identificacion` varchar(10) NOT NULL COMMENT 'Número de cédula, NIT o documento oficial',
  `estado_cliente` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = activo, 0 = inactivo',
  `foto_perfil_id` int(11) DEFAULT NULL,
  `tipo_cliente` enum('Oro','Plata','Bronce','Hierro') NOT NULL DEFAULT 'Hierro',
  `n_telefono` varchar(10) NOT NULL COMMENT 'Número telefónico de contacto con código de país',
  `Direccion_recidencia` varchar(255) NOT NULL COMMENT 'Dirección de residencia del cliente',
  `correoE` varchar(150) NOT NULL COMMENT 'Correo electrónico de contacto del cliente',
  `sexo` enum('Masculino','Femenino','Otro','') NOT NULL COMMENT 'Sexo o género del cliente',
  `estatura_m` decimal(3,2) DEFAULT NULL COMMENT 'Estatura en metros, ejemplo: 1.75',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro del cliente',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento del cliente',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada con hash',
  `ciudad` int(11) NOT NULL COMMENT 'ID de la ciudad del cliente',
  `id_administrador` int(11) DEFAULT NULL COMMENT 'ID del administrador que registró/modificó al cliente',
  `id_clientes` int(11) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL COMMENT 'Fecha de verificación de correo',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de eliminación lógica',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`nombres`, `apellidos`, `tipo_identificacion`, `n_identificacion`, `estado_cliente`, `foto_perfil_id`, `tipo_cliente`, `n_telefono`, `Direccion_recidencia`, `correoE`, `sexo`, `estatura_m`, `fecha_registro`, `fecha_nacimiento`, `password`, `ciudad`, `id_administrador`, `id_clientes`, `email_verified_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
('carlosandres', 'corrales diaz', 'Cedula de ciudadania (CC)', '1077480909', 1, NULL, 'Hierro', '3102589323', 'barrio cielo', 'carlos@carlos.coom', 'Masculino', 1.78, '2025-06-03 02:13:35', NULL, '$2y$12$aKjCAbah5kwNB.vcNRmhtem2dzvB5daBLewt/j6RYN8h94yOo9WoO', 1, NULL, 7, NULL, NULL, '2025-06-02 21:13:35', '2025-06-02 21:13:35'),
('Pedro', 'López', 'Cedula de ciudadania (CC)', '8765432109', 1, NULL, 'Hierro', '3124444444', 'Av 5 #15-25', 'pedro@example.com', 'Masculino', NULL, '2025-05-14 22:08:14', NULL, '', 2, 2, 2, NULL, NULL, '2025-05-31 23:42:04', '2025-06-01 07:42:18'),
('Ana', 'Rodríguez', 'Cedula de ciudadania (CC)', '9876543210', 1, NULL, 'Hierro', '3105555555', 'Cra 10 #20-30', 'ana@example.com', 'Femenino', NULL, '2025-05-14 22:08:14', NULL, '', 1, 1, 1, NULL, '2025-06-01 12:42:21', '2025-05-31 23:42:04', '2025-06-01 07:42:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos_identificadores`
--

CREATE TABLE `codigos_identificadores` (
  `id_codigo` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = activo, 0 = inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colorproducto`
--

CREATE TABLE `colorproducto` (
  `idColor` int(11) NOT NULL,
  `nombreColor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colorproducto`
--

INSERT INTO `colorproducto` (`idColor`, `nombreColor`) VALUES
(30, 'Negro'),
(31, 'Blanco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones_descuento`
--

CREATE TABLE `cupones_descuento` (
  `id_cupon` int(11) NOT NULL,
  `codigo_cupon` varchar(50) NOT NULL,
  `tipo_descuento` enum('Porcentaje','Valor fijo') NOT NULL,
  `valor_comprado` int(10) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `cantidad_prudcutos_minimos` int(11) NOT NULL,
  `max_usos_por_cliente` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cupones_descuento`
--

INSERT INTO `cupones_descuento` (`id_cupon`, `codigo_cupon`, `tipo_descuento`, `valor_comprado`, `valor`, `fecha_expiracion`, `activo`, `cantidad_prudcutos_minimos`, `max_usos_por_cliente`) VALUES
(1, 'DESC20', 'Porcentaje', 150000, 20000.00, '2025-12-31', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones_usados`
--

CREATE TABLE `cupones_usados` (
  `id_cupon_usado` int(11) NOT NULL,
  `id_cupon` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `fecha_uso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`) VALUES
(1, 'Antioquia'),
(2, 'Bogotá D.C.'),
(3, 'Cundinamarca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `id_talla` int(11) DEFAULT NULL COMMENT 'Talla seleccionada',
  `cantidad_pedido` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `id_talla` int(11) DEFAULT NULL COMMENT 'Talla vendida',
  `id_color` int(11) DEFAULT NULL COMMENT 'Color vendido',
  `cantidad_vendida` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id_devolucion` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_talla` int(11) DEFAULT NULL COMMENT 'Talla devuelta',
  `id_color` int(11) DEFAULT NULL COMMENT 'Color devuelto',
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `motivo_devolucion` text DEFAULT NULL,
  `fecha_devolucion` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_devolucion` enum('Pendiente','Aprobada','Rechazada') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadooferta`
--

CREATE TABLE `estadooferta` (
  `idEstadoOferta` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadooferta`
--

INSERT INTO `estadooferta` (`idEstadoOferta`, `estado`) VALUES
(1, 'En oferta'),
(2, 'Finalizada'),
(3, 'Sin oferta'),
(4, 'En oferta'),
(5, 'Finalizada'),
(6, 'Sin oferta'),
(7, 'En oferta'),
(8, 'Finalizada'),
(9, 'Sin oferta'),
(10, 'En oferta'),
(11, 'Finalizada'),
(12, 'Sin oferta'),
(13, 'En oferta'),
(14, 'Finalizada'),
(15, 'Sin oferta'),
(16, 'En oferta'),
(17, 'Finalizada'),
(18, 'Sin oferta'),
(19, 'En oferta'),
(20, 'Finalizada'),
(21, 'Sin oferta'),
(22, 'En oferta'),
(23, 'Finalizada'),
(24, 'Sin oferta'),
(25, 'En oferta'),
(26, 'Finalizada'),
(27, 'Sin oferta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproducto`
--

CREATE TABLE `estadoproducto` (
  `idEstadoProducto` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadoproducto`
--

INSERT INTO `estadoproducto` (`idEstadoProducto`, `estado`) VALUES
(1, 'Disponible'),
(2, 'Agotado'),
(3, 'Descontinuado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `apellido_cliente` varchar(100) NOT NULL,
  `correo_cliente` varchar(150) DEFAULT NULL,
  `telefono_cliente` varchar(10) DEFAULT NULL,
  `direccion_cliente` varchar(255) DEFAULT NULL,
  `metodo_pago` enum('Efectivo','Tarjeta','Transferencia','Contraentrega') NOT NULL,
  `fecha_factura` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado_factura` enum('Activa','Anulada','Impresa','Digital','Temporal') NOT NULL DEFAULT 'Digital',
  `id_administrador` int(11) DEFAULT NULL COMMENT 'Quién generó la factura (si aplica)',
  `notas` text DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `n_identificacion_cliente` varchar(10) DEFAULT NULL,
  `id_administrador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos_clientes`
--

CREATE TABLE `favoritos_clientes` (
  `id_favorito` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `fecha_agregado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_perfil_admin`
--

CREATE TABLE `foto_perfil_admin` (
  `id_foto_perfil` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL COMMENT 'Ruta o nombre del archivo',
  `id_administrador` varchar(10) NOT NULL COMMENT 'Administrador al que pertenece la foto',
  `fecha_subida` datetime NOT NULL DEFAULT current_timestamp(),
  `principal` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_perfil_cliente`
--

CREATE TABLE `foto_perfil_cliente` (
  `id_foto_perfil` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL COMMENT 'Ruta o nombre de la imagen de perfil',
  `n_identificacion_cliente` varchar(10) NOT NULL COMMENT 'Cliente al que pertenece la imagen',
  `fecha_subida` datetime NOT NULL DEFAULT current_timestamp(),
  `principal` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Imagen actual, 0 = Anterior o eliminada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_acciones_clientes`
--

CREATE TABLE `historial_acciones_clientes` (
  `id_registro` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_accion` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_cliente` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estados_venta`
--

CREATE TABLE `historial_estados_venta` (
  `id_historial_estado_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `estado_venta` enum('Pendiente','Completada','Cancelada') NOT NULL,
  `fecha_cambio` datetime NOT NULL DEFAULT current_timestamp(),
  `id_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_estados_venta`
--

INSERT INTO `historial_estados_venta` (`id_historial_estado_venta`, `id_venta`, `estado_venta`, `fecha_cambio`, `id_administrador`) VALUES
(1, 1, 'Completada', '2025-05-14 17:27:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_precios`
--

CREATE TABLE `historial_precios` (
  `id_historial` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio_anterior` decimal(10,2) NOT NULL,
  `precio_nuevo` decimal(10,2) NOT NULL,
  `fecha_cambio` datetime NOT NULL DEFAULT current_timestamp(),
  `id_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_producto`
--

CREATE TABLE `imagenes_producto` (
  `id_imagen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL COMMENT 'ID del producto al que pertenece la imagen',
  `url_imagen` varchar(255) NOT NULL COMMENT 'URL de la imagen',
  `orden` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_productos`
--

CREATE TABLE `inventario_productos` (
  `id_inventario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `stock_actual` int(11) NOT NULL DEFAULT 0,
  `stock_minimo` int(11) NOT NULL DEFAULT 10,
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp(),
  `id_administrador` int(11) NOT NULL,
  `codigo_producto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_producto`
--

CREATE TABLE `marca_producto` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado_marca` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_soporte`
--

CREATE TABLE `mensajes_soporte` (
  `id_mensaje` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `id_administrador` int(11) DEFAULT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_mensaje` enum('Abierto','Respondido','Cerrado') NOT NULL DEFAULT 'Abierto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes_soporte`
--

INSERT INTO `mensajes_soporte` (`id_mensaje`, `n_identificacion_cliente`, `id_administrador`, `asunto`, `mensaje`, `fecha_envio`, `estado_mensaje`) VALUES
(1, '9876543210', 1, 'Consulta sobre envío', '¿Cuándo llegará mi pedido?', '2025-05-14 17:27:54', 'Abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` enum('Efectivo','Tarjeta','Transferencia Bancaria','PayU','Mercado Pago','PayPal') NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `descripcion` text DEFAULT NULL,
  `configuracion_adicional` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`configuracion_adicional`)),
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `id_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_admins`
--

CREATE TABLE `notificaciones_admins` (
  `id_notificacion` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `id_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones_admins`
--

INSERT INTO `notificaciones_admins` (`id_notificacion`, `mensaje`, `leido`, `fecha_creacion`, `id_administrador`) VALUES
(1, 'Nuevo pedido recibido', 0, '2025-05-14 17:27:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_clientes`
--

CREATE TABLE `notificaciones_clientes` (
  `id_notificacion` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL COMMENT 'Cliente al que va dirigida la notificación',
  `titulo` varchar(255) NOT NULL COMMENT 'Título del mensaje o aviso',
  `mensaje` text NOT NULL COMMENT 'Contenido detallado de la notificación',
  `tipo_notificacion` enum('Promoción','Descuento','Mantenimiento','Mensaje personal','Recordatorio','Otro') NOT NULL DEFAULT 'Otro',
  `leido` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = no leído, 1 = leído',
  `importante` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = normal, 1 = destacado/importante',
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora de envío de la notificación',
  `fecha_lectura` datetime DEFAULT NULL COMMENT 'Fecha en que el cliente marcó la notificación como leída (opcional)',
  `id_administrador` int(11) DEFAULT NULL COMMENT 'Administrador que envió el mensaje (si aplica)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones_clientes`
--

INSERT INTO `notificaciones_clientes` (`id_notificacion`, `n_identificacion_cliente`, `titulo`, `mensaje`, `tipo_notificacion`, `leido`, `importante`, `fecha_envio`, `fecha_lectura`, `id_administrador`) VALUES
(1, '9876543210', 'Nueva oferta', '¡Tienes un cupón de descuento!', 'Promoción', 0, 0, '2025-05-14 17:27:54', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_por_categoria`
--

CREATE TABLE `ofertas_por_categoria` (
  `id_oferta_categoria` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `idEstadoOferta` int(11) NOT NULL,
  `idTipoOferta` int(11) NOT NULL,
  `valor_oferta` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas_por_categoria`
--

INSERT INTO `ofertas_por_categoria` (`id_oferta_categoria`, `id_categoria`, `idEstadoOferta`, `idTipoOferta`, `valor_oferta`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 1, 1, 1, 20.00, '2025-05-10', '2025-05-30'),
(2, 1, 1, 1, 20.00, '2025-05-10', '2025-05-30'),
(3, 1, 1, 1, 20.00, '2025-05-10', '2025-05-30'),
(4, 1, 1, 1, 20.00, '2025-05-10', '2025-05-30'),
(5, 1, 1, 1, 20.00, '2025-05-10', '2025-05-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_pedido` enum('En proceso','Enviado','Entregado','Cancelado') NOT NULL DEFAULT 'En proceso',
  `direccion_envio` varchar(255) NOT NULL,
  `ciudad_envio` int(11) NOT NULL,
  `total_pedido` decimal(10,2) NOT NULL,
  `metodo_pago` enum('Efectivo','Tarjeta','Transferencia','PayPal','Contraentrega') NOT NULL DEFAULT 'Efectivo',
  `recoleccion_en_local` tinyint(1) NOT NULL DEFAULT 0,
  `factura_generada` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `n_identificacion_cliente`, `fecha_pedido`, `estado_pedido`, `direccion_envio`, `ciudad_envio`, `total_pedido`, `metodo_pago`, `recoleccion_en_local`, `factura_generada`, `created_at`, `updated_at`) VALUES
(1, '9876543210', '2025-05-14 17:08:14', 'En proceso', 'Cra 10 #20-30', 1, 30.00, 'Efectivo', 0, 0, '2025-05-30 16:37:48', '2025-05-30 16:37:48'),
(2, '9876543210', '2025-05-14 17:27:54', 'En proceso', 'Cra 10 #20-30', 1, 30.00, 'Efectivo', 0, 0, '2025-05-30 16:37:48', '2025-05-30 16:37:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `codigoIdentificador` varchar(50) NOT NULL COMMENT 'Código único del producto',
  `nombreProducto` varchar(100) NOT NULL,
  `precioProducto` decimal(10,2) NOT NULL COMMENT 'Precio del producto',
  `tallaProducto` varchar(10) DEFAULT NULL,
  `idClaseProducto` int(11) NOT NULL,
  `idSexoProducto` int(11) NOT NULL,
  `cantidadDisponible` int(11) DEFAULT 0,
  `descripcionProducto` text DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT 0,
  `idEstadoOferta` int(11) DEFAULT NULL,
  `idTipoOferta` int(11) DEFAULT NULL,
  `valor_oferta` decimal(10,2) DEFAULT NULL COMMENT 'Valor del descuento (porcentaje o fijo)',
  `idColor` int(11) NOT NULL,
  `idEstadoProducto` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `fechaIngreso` datetime NOT NULL DEFAULT current_timestamp(),
  `calificacion` decimal(3,2) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `id_administrador` int(11) NOT NULL COMMENT 'ID del administrador que creó/modificó el producto',
  `ultima_modificacion_oferta` datetime DEFAULT NULL,
  `id_administrador_oferta` int(11) DEFAULT NULL,
  `fecha_inicio_oferta` datetime DEFAULT NULL COMMENT 'Fecha de inicio de la oferta',
  `fecha_fin_oferta` datetime DEFAULT NULL COMMENT 'Fecha de finalización de la oferta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas_productos`
--

CREATE TABLE `resenas_productos` (
  `id_resena` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `calificacion` tinyint(4) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_resena` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_resena` enum('Pendiente','Aprobada','Rechazada') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_administradores`
--

CREATE TABLE `roles_administradores` (
  `id_rol_admin` int(11) NOT NULL COMMENT 'ID único del rol del administrador',
  `nombre_rol` varchar(50) NOT NULL COMMENT 'Nombre del rol del administrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles_administradores`
--

INSERT INTO `roles_administradores` (`id_rol_admin`, `nombre_rol`) VALUES
(3, 'Soporte'),
(1, 'Superadmin'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1rUb0VtjyJPuz0bJq0joVZ1eGExzU95i0rrs7ioy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT3VNUVdKSWJoRjJ2Y3FOdXFQUk1RaUtYaDRVdU5weW5tVkJmaGxubSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8xL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjI6ImxvZ2luX2FkbWluaXN0cmFkb3Jlc181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjE5OiJhZG1pbmlzQGFkbWluaXMuY29tIjtzOjU1OiJsb2dpbl9jbGllbnRlc181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwNzc0ODA5MDk7fQ==', 1748931464),
('60aFgagn9wYRsiAeJ9UDi9BD3GDe5iH0vLYzYX8K', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQkZFRlM4YkFvZU9QS05KT0Z5c3RuWTFYZ3lmUnhwa1NFTDNic3dXYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NTU6ImxvZ2luX2NsaWVudGVzXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA3NzQ4MDkwOTt9', 1748909998),
('kmR4BaEYweIndJGmOMKp78JuVBFPT3K82xmtFEIh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYjFCcmNvMmhuN3JmOG5ZTlhOaWlZUWRIakk5bzVKdmdHMkZGdkp6NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8xL3BlZGlkb3MiO31zOjYyOiJsb2dpbl9hZG1pbmlzdHJhZG9yZXNfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czoxOToiYWRtaW5pc0BhZG1pbmlzLmNvbSI7czo1NToibG9naW5fY2xpZW50ZXNfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMDc3NDgwOTA5O30=', 1748914597),
('P6BSpGqA5wvO7PyRKpshrcnjGrgIWXn2buy6pCFO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicUJ5SnV3cUcwYXhPUHdpYXE3SVFuR0ZkeWxFeUgyTUd5cENoN2NXbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8xL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjI6ImxvZ2luX2FkbWluaXN0cmFkb3Jlc181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjE5OiJhZG1pbmlzQGFkbWluaXMuY29tIjt9', 1748953195);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexoproducto`
--

CREATE TABLE `sexoproducto` (
  `idSexoProducto` int(11) NOT NULL,
  `nombreSexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas_producto`
--

CREATE TABLE `tallas_producto` (
  `id_talla` int(11) NOT NULL,
  `nombre_talla` varchar(20) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tallas_producto`
--

INSERT INTO `tallas_producto` (`id_talla`, `nombre_talla`, `descripcion`) VALUES
(1, 'XS', 'Extra Small'),
(2, 'S', 'Small'),
(3, 'M', 'Medium'),
(4, 'L', 'Large'),
(5, 'XL', 'Extra Large'),
(6, '36', 'Talla 36'),
(7, '37', 'Talla 37'),
(8, '38', 'Talla 38'),
(9, '39', 'Talla 39'),
(10, '40', 'Talla 40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipooferta`
--

CREATE TABLE `tipooferta` (
  `idTipoOferta` int(11) NOT NULL,
  `nombreTipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipooferta`
--

INSERT INTO `tipooferta` (`idTipoOferta`, `nombreTipo`) VALUES
(1, 'Descuento por porcentaje'),
(2, 'Descuento fijo'),
(3, 'Descuento por porcentaje'),
(4, 'Descuento fijo'),
(5, 'Descuento por porcentaje'),
(6, 'Descuento fijo'),
(7, 'Descuento por porcentaje'),
(8, 'Descuento fijo'),
(9, 'Descuento por porcentaje'),
(10, 'Descuento fijo'),
(11, 'Descuento por porcentaje'),
(12, 'Descuento fijo'),
(13, 'Descuento por porcentaje'),
(14, 'Descuento fijo'),
(15, 'Descuento por porcentaje'),
(16, 'Descuento fijo'),
(17, 'Descuento por porcentaje'),
(18, 'Descuento fijo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `total_venta` decimal(10,2) NOT NULL,
  `estado_venta` enum('Pendiente','Completada','Cancelada') NOT NULL DEFAULT 'Pendiente',
  `metodo_pago` enum('Efectivo','Tarjeta','Transferencia','PayPal') NOT NULL,
  `id_administrador` int(11) NOT NULL,
  `recoleccion_en_local` tinyint(1) NOT NULL DEFAULT 0,
  `factura_generada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `n_identificacion_cliente`, `fecha_venta`, `total_venta`, `estado_venta`, `metodo_pago`, `id_administrador`, `recoleccion_en_local`, `factura_generada`) VALUES
(1, '9876543210', '2025-05-14 17:08:14', 30.00, 'Pendiente', 'Tarjeta', 1, 0, 0),
(2, '9876543210', '2025-05-14 17:27:54', 30.00, 'Pendiente', 'Tarjeta', 1, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_administrador`),
  ADD UNIQUE KEY `correoE` (`correoE`),
  ADD UNIQUE KEY `n_identificacion` (`n_identificacion`),
  ADD KEY `id_rol_admin` (`id_rol_admin`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `fk_carrito_talla` (`id_talla`),
  ADD KEY `fk_carrito_color` (`id_color`);

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD UNIQUE KEY `nombre_ciudad` (`nombre_ciudad`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `claseproducto`
--
ALTER TABLE `claseproducto`
  ADD PRIMARY KEY (`idClaseProducto`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`n_identificacion`),
  ADD UNIQUE KEY `correoE` (`correoE`),
  ADD UNIQUE KEY `id_clientes` (`id_clientes`),
  ADD KEY `fk_clientes_ciudades` (`ciudad`),
  ADD KEY `fk_clientes_administradores` (`id_administrador`);

--
-- Indices de la tabla `codigos_identificadores`
--
ALTER TABLE `codigos_identificadores`
  ADD PRIMARY KEY (`id_codigo`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `colorproducto`
--
ALTER TABLE `colorproducto`
  ADD PRIMARY KEY (`idColor`);

--
-- Indices de la tabla `cupones_descuento`
--
ALTER TABLE `cupones_descuento`
  ADD PRIMARY KEY (`id_cupon`),
  ADD UNIQUE KEY `codigo_cupon` (`codigo_cupon`);

--
-- Indices de la tabla `cupones_usados`
--
ALTER TABLE `cupones_usados`
  ADD PRIMARY KEY (`id_cupon_usado`),
  ADD KEY `id_cupon` (`id_cupon`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`),
  ADD UNIQUE KEY `nombre_departamento` (`nombre_departamento`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `fk_detalle_talla` (`id_talla`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `fk_detalle_venta_talla` (`id_talla`),
  ADD KEY `fk_detalle_venta_color` (`id_color`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `idx_cliente_estado` (`n_identificacion_cliente`,`estado_devolucion`),
  ADD KEY `fk_devolucion_talla` (`id_talla`),
  ADD KEY `fk_devolucion_color` (`id_color`);

--
-- Indices de la tabla `estadooferta`
--
ALTER TABLE `estadooferta`
  ADD PRIMARY KEY (`idEstadoOferta`);

--
-- Indices de la tabla `estadoproducto`
--
ALTER TABLE `estadoproducto`
  ADD PRIMARY KEY (`idEstadoProducto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `favoritos_clientes`
--
ALTER TABLE `favoritos_clientes`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `foto_perfil_admin`
--
ALTER TABLE `foto_perfil_admin`
  ADD PRIMARY KEY (`id_foto_perfil`),
  ADD UNIQUE KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `foto_perfil_cliente`
--
ALTER TABLE `foto_perfil_cliente`
  ADD PRIMARY KEY (`id_foto_perfil`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`);

--
-- Indices de la tabla `historial_acciones_clientes`
--
ALTER TABLE `historial_acciones_clientes`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`);

--
-- Indices de la tabla `historial_estados_venta`
--
ALTER TABLE `historial_estados_venta`
  ADD PRIMARY KEY (`id_historial_estado_venta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `fk_imagenes_producto` (`id_producto`);

--
-- Indices de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `id_administrador` (`id_administrador`),
  ADD KEY `fk_inventario_codigo` (`codigo_producto`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca_producto`
--
ALTER TABLE `marca_producto`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones_admins`
--
ALTER TABLE `notificaciones_admins`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `notificaciones_clientes`
--
ALTER TABLE `notificaciones_clientes`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `fk_notificaciones_cliente` (`n_identificacion_cliente`),
  ADD KEY `fk_notificaciones_administrador` (`id_administrador`),
  ADD KEY `idx_cliente_leido` (`n_identificacion_cliente`,`leido`),
  ADD KEY `idx_fecha_envio` (`fecha_envio`);

--
-- Indices de la tabla `ofertas_por_categoria`
--
ALTER TABLE `ofertas_por_categoria`
  ADD PRIMARY KEY (`id_oferta_categoria`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `idEstadoOferta` (`idEstadoOferta`),
  ADD KEY `idTipoOferta` (`idTipoOferta`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `ciudad_envio` (`ciudad_envio`),
  ADD KEY `idx_cliente_estado` (`n_identificacion_cliente`,`estado_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `codigoIdentificador` (`codigoIdentificador`),
  ADD UNIQUE KEY `idx_codigo_identificador` (`codigoIdentificador`),
  ADD KEY `fk_productos_claseproducto` (`idClaseProducto`),
  ADD KEY `fk_productos_sexoproducto` (`idSexoProducto`),
  ADD KEY `fk_productos_estadooferta` (`idEstadoOferta`),
  ADD KEY `fk_productos_tipooferta` (`idTipoOferta`),
  ADD KEY `fk_productos_colorproducto` (`idColor`),
  ADD KEY `fk_productos_estadoproducto` (`idEstadoProducto`),
  ADD KEY `fk_productos_administradores` (`id_administrador`),
  ADD KEY `fk_producto_categoria` (`id_categoria`),
  ADD KEY `fk_producto_admin_oferta` (`id_administrador_oferta`);

--
-- Indices de la tabla `resenas_productos`
--
ALTER TABLE `resenas_productos`
  ADD PRIMARY KEY (`id_resena`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `roles_administradores`
--
ALTER TABLE `roles_administradores`
  ADD PRIMARY KEY (`id_rol_admin`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sexoproducto`
--
ALTER TABLE `sexoproducto`
  ADD PRIMARY KEY (`idSexoProducto`);

--
-- Indices de la tabla `tallas_producto`
--
ALTER TABLE `tallas_producto`
  ADD PRIMARY KEY (`id_talla`);

--
-- Indices de la tabla `tipooferta`
--
ALTER TABLE `tipooferta`
  ADD PRIMARY KEY (`idTipoOferta`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_administrador` (`id_administrador`),
  ADD KEY `idx_cliente_estado` (`n_identificacion_cliente`,`estado_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único del administrador', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `claseproducto`
--
ALTER TABLE `claseproducto`
  MODIFY `idClaseProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `codigos_identificadores`
--
ALTER TABLE `codigos_identificadores`
  MODIFY `id_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colorproducto`
--
ALTER TABLE `colorproducto`
  MODIFY `idColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `cupones_descuento`
--
ALTER TABLE `cupones_descuento`
  MODIFY `id_cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cupones_usados`
--
ALTER TABLE `cupones_usados`
  MODIFY `id_cupon_usado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadooferta`
--
ALTER TABLE `estadooferta`
  MODIFY `idEstadoOferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `estadoproducto`
--
ALTER TABLE `estadoproducto`
  MODIFY `idEstadoProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `favoritos_clientes`
--
ALTER TABLE `favoritos_clientes`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `foto_perfil_admin`
--
ALTER TABLE `foto_perfil_admin`
  MODIFY `id_foto_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto_perfil_cliente`
--
ALTER TABLE `foto_perfil_cliente`
  MODIFY `id_foto_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_acciones_clientes`
--
ALTER TABLE `historial_acciones_clientes`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_estados_venta`
--
ALTER TABLE `historial_estados_venta`
  MODIFY `id_historial_estado_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca_producto`
--
ALTER TABLE `marca_producto`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificaciones_admins`
--
ALTER TABLE `notificaciones_admins`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notificaciones_clientes`
--
ALTER TABLE `notificaciones_clientes`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ofertas_por_categoria`
--
ALTER TABLE `ofertas_por_categoria`
  MODIFY `id_oferta_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `resenas_productos`
--
ALTER TABLE `resenas_productos`
  MODIFY `id_resena` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles_administradores`
--
ALTER TABLE `roles_administradores`
  MODIFY `id_rol_admin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único del rol del administrador', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sexoproducto`
--
ALTER TABLE `sexoproducto`
  MODIFY `idSexoProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tallas_producto`
--
ALTER TABLE `tallas_producto`
  MODIFY `id_talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipooferta`
--
ALTER TABLE `tipooferta`
  MODIFY `idTipoOferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `fk_administradores_roles` FOREIGN KEY (`id_rol_admin`) REFERENCES `roles_administradores` (`id_rol_admin`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_carrito_color` FOREIGN KEY (`id_color`) REFERENCES `colorproducto` (`idColor`),
  ADD CONSTRAINT `fk_carrito_talla` FOREIGN KEY (`id_talla`) REFERENCES `tallas_producto` (`id_talla`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `fk_ciudades_departamentos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_administradores` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clientes_ciudades` FOREIGN KEY (`ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cupones_usados`
--
ALTER TABLE `cupones_usados`
  ADD CONSTRAINT `cupones_usados_ibfk_1` FOREIGN KEY (`id_cupon`) REFERENCES `cupones_descuento` (`id_cupon`),
  ADD CONSTRAINT `cupones_usados_ibfk_2` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`);

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_detalle_talla` FOREIGN KEY (`id_talla`) REFERENCES `tallas_producto` (`id_talla`);

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_detalle_venta_color` FOREIGN KEY (`id_color`) REFERENCES `colorproducto` (`idColor`),
  ADD CONSTRAINT `fk_detalle_venta_talla` FOREIGN KEY (`id_talla`) REFERENCES `tallas_producto` (`id_talla`);

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `fk_devolucion_color` FOREIGN KEY (`id_color`) REFERENCES `colorproducto` (`idColor`),
  ADD CONSTRAINT `fk_devolucion_talla` FOREIGN KEY (`id_talla`) REFERENCES `tallas_producto` (`id_talla`);

--
-- Filtros para la tabla `favoritos_clientes`
--
ALTER TABLE `favoritos_clientes`
  ADD CONSTRAINT `favoritos_clientes_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `favoritos_clientes_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `foto_perfil_cliente`
--
ALTER TABLE `foto_perfil_cliente`
  ADD CONSTRAINT `foto_perfil_cliente_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_acciones_clientes`
--
ALTER TABLE `historial_acciones_clientes`
  ADD CONSTRAINT `historial_acciones_clientes_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`);

--
-- Filtros para la tabla `historial_estados_venta`
--
ALTER TABLE `historial_estados_venta`
  ADD CONSTRAINT `historial_estados_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `historial_estados_venta_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`);

--
-- Filtros para la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  ADD CONSTRAINT `historial_precios_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `historial_precios_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`);

--
-- Filtros para la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD CONSTRAINT `fk_imagenes_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  ADD CONSTRAINT `fk_inventario_codigo` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigoIdentificador`),
  ADD CONSTRAINT `inventario_productos_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `inventario_productos_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`);

--
-- Filtros para la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  ADD CONSTRAINT `mensajes_soporte_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `mensajes_soporte_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`);

--
-- Filtros para la tabla `notificaciones_admins`
--
ALTER TABLE `notificaciones_admins`
  ADD CONSTRAINT `notificaciones_admins_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`);

--
-- Filtros para la tabla `notificaciones_clientes`
--
ALTER TABLE `notificaciones_clientes`
  ADD CONSTRAINT `fk_notificaciones_admin` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_notificaciones_administrador` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notificaciones_cliente` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas_por_categoria`
--
ALTER TABLE `ofertas_por_categoria`
  ADD CONSTRAINT `ofertas_por_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_productos` (`id_categoria`),
  ADD CONSTRAINT `ofertas_por_categoria_ibfk_2` FOREIGN KEY (`idEstadoOferta`) REFERENCES `estadooferta` (`idEstadoOferta`),
  ADD CONSTRAINT `ofertas_por_categoria_ibfk_3` FOREIGN KEY (`idTipoOferta`) REFERENCES `tipooferta` (`idTipoOferta`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`ciudad_envio`) REFERENCES `ciudades` (`id_ciudad`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_admin_oferta` FOREIGN KEY (`id_administrador_oferta`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_productos` (`id_categoria`),
  ADD CONSTRAINT `fk_productos_administradores` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_claseproducto` FOREIGN KEY (`idClaseProducto`) REFERENCES `claseproducto` (`idClaseProducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_colorproducto` FOREIGN KEY (`idColor`) REFERENCES `colorproducto` (`idColor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_estadooferta` FOREIGN KEY (`idEstadoOferta`) REFERENCES `estadooferta` (`idEstadoOferta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_estadoproducto` FOREIGN KEY (`idEstadoProducto`) REFERENCES `estadoproducto` (`idEstadoProducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_sexoproducto` FOREIGN KEY (`idSexoProducto`) REFERENCES `sexoproducto` (`idSexoProducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_tipooferta` FOREIGN KEY (`idTipoOferta`) REFERENCES `tipooferta` (`idTipoOferta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `resenas_productos`
--
ALTER TABLE `resenas_productos`
  ADD CONSTRAINT `resenas_productos_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `resenas_productos_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
