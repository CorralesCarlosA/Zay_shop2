-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<< HEAD
-- Tiempo de generación: 09-05-2025 a las 23:50:00
=======
-- Tiempo de generación: 08-05-2025 a las 17:58:10
>>>>>>> 14fd044e732d924331039f1d1fabfb86bc048105
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
-- Base de datos: `zay_shop`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `id_categoria_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(50) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claseproducto`
--

CREATE TABLE `claseproducto` (
  `idClaseProducto` int(11) NOT NULL,
  `nombreClase` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tipo_cliente` enum('Oro','Plata','Bronce','Hierro') NOT NULL DEFAULT 'Hierro',
  `n_telefono` varchar(10) NOT NULL COMMENT 'Número telefónico de contacto con código de país',
  `Direccion_recidencia` varchar(255) NOT NULL COMMENT 'Dirección de residencia del cliente',
  `correoE` varchar(150) NOT NULL COMMENT 'Correo electrónico de contacto del cliente',
  `sexo` enum('Masculino','Femenino','Otro','') NOT NULL COMMENT 'Sexo o género del cliente',
  `estatura(m)` decimal(3,2) DEFAULT NULL COMMENT 'Estatura en metros, ejemplo: 1.75',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro del cliente',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada con hash',
  `ciudad` int(11) NOT NULL COMMENT 'ID de la ciudad del cliente',
  `id_administrador` int(11) NOT NULL COMMENT 'ID del administrador que registró/modificó al cliente',
  `id_clientes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colorproducto`
--

CREATE TABLE `colorproducto` (
  `idColor` int(11) NOT NULL,
  `nombreColor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
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
(3, 'Sin oferta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproducto`
--

CREATE TABLE `estadoproducto` (
  `idEstadoProducto` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
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
  `id_administrador` int(11) NOT NULL
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
  `total_pedido` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `precioProducto` decimal(10,2) NOT NULL COMMENT 'Precio del producto',
  `tallaProducto` varchar(10) DEFAULT NULL,
  `idClaseProducto` int(11) NOT NULL,
  `idSexoProducto` int(11) NOT NULL,
  `cantidadDisponible` int(11) DEFAULT 0,
  `descripcionProducto` text DEFAULT NULL,
  `codigoIdentificador` varchar(50) NOT NULL,
  `idEstadoOferta` int(11) DEFAULT NULL,
  `idTipoOferta` int(11) DEFAULT NULL,
  `valor_oferta` decimal(10,2) DEFAULT NULL COMMENT 'Valor del descuento (porcentaje o fijo)',
  `idColor` int(11) NOT NULL,
  `idEstadoProducto` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `fechaIngreso` datetime NOT NULL DEFAULT current_timestamp(),
  `calificacion` decimal(3,2) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `id_administrador` int(11) NOT NULL COMMENT 'ID del administrador que creó/modificó el producto',
  `ultima_modificacion_oferta` datetime DEFAULT NULL,
<<<<<<< HEAD
  `id_administrador_oferta` int(11) DEFAULT NULL,
  `fecha_inicio_oferta` datetime DEFAULT NULL COMMENT 'Fecha de inicio de la oferta',
  `fecha_fin_oferta` datetime DEFAULT NULL COMMENT 'Fecha de finalización de la oferta'
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas_productos`
--

CREATE TABLE `reseñas_productos` (
  `id_reseña` int(11) NOT NULL,
  `n_identificacion_cliente` varchar(10) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `calificacion` tinyint(4) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_reseña` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_reseña` enum('Pendiente','Aprobada','Rechazada') NOT NULL DEFAULT 'Pendiente'
) ;
=======
  `id_administrador_oferta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
>>>>>>> 14fd044e732d924331039f1d1fabfb86bc048105

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_administradores`
--

CREATE TABLE `roles_administradores` (
  `id_rol_admin` int(11) NOT NULL COMMENT 'ID único del rol del administrador',
  `nombre_rol` varchar(50) NOT NULL COMMENT 'Nombre del rol del administrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('2Hx6HpDXFi8LahKujU2Gt95nDhHcrXT4Lir5AaCJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVpSbDNiWE1vcTE3ckJ2a2hBeXNYNU5lMktWejQ4WHpVUGxNTTNyOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXJmaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746046794),
('31GEpr9PBhSvFLLiP93JHzYf21nOP2SbVGzrEtRz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnc0cDZFSk9iZ1I0OWk3NnBDTTVWa3pYVDJ1WFVwandSZ2RMQUdTSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746495035),
('5p9JlIbfUKEtwISpRTNEorD0x8YmoPfjy8gEZElb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHNQOXNpeUpJeWt2SUdyRXdvOWNMN0pXbkU0RG9vR2NkU1BEUzFhViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXJmaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1745965869),
('B1UmgiRXckF2qa1RK9w2GZIhk6mj73DqZoDvFQMy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVBWZFdIc0FMZnZxdUZXV1F4VXo1eDVsWFlsNmxLODh2TVlVOUNTMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746534317),
('FkTQXRlypbq90aNTjchrnAe2N94F4Z7l5YvnqeWI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialYzSlM2WW5qRlZGN1g2cWJCMkZvZW9jYUczVEtFcndqSzZVc1dINyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746144275),
<<<<<<< HEAD
('JH7UnrxxYSfhUWPo69GWZu3vgT8fhtCexX2Fm2Qn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmk1b29QT011dVpEQ2ZuTmRNVThBZ0lGRWFDaUtndldGVE5vYTRaeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746827258),
=======
>>>>>>> 14fd044e732d924331039f1d1fabfb86bc048105
('uESa873PpIGecTgY07rfcNbLICTdF5X52qTUwTiQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHAwU1pVelFjcUZWak5mYkYyY0l6SVlDcXN0SjFncEJXRDRybk5ueiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXJmaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1745965858),
('VVQikicRAZA462FCiHCBbVuQtekzAR8KCyPaaVux', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3pvWVh1Ym1xY1RGb0pqTk1IT1Q0T2d1Smw5aUdKNngwM0tkTXFzeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746560164),
('VwX0FADuHt8L5DYlpytgUbiUnTmYRZXCQt9jKzFP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0pNTHd3MHo2N3JTQjZ5Wm1MNHBqNzRvMm1DQ0FTbmNlVEk3aW5DaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXJmaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746719036),
('ZVbWRI9PLdfMxgzi8AYpu66zcQIUjUA8b9Ftj0L9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialZtdEtVZlp0N2dpZVd0QlduQUFzQTVMR0FpUHR1ekZJNUN4bW1jbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746396896);

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
-- Estructura de tabla para la tabla `tipooferta`
--

CREATE TABLE `tipooferta` (
  `idTipoOferta` int(11) NOT NULL,
  `nombreTipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id_categoria_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_producto` (`id_producto`);

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
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `idx_cliente_estado` (`n_identificacion_cliente`,`estado_devolucion`);

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
  ADD KEY `id_administrador` (`id_administrador`);

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
-- Indices de la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`),
  ADD KEY `id_administrador` (`id_administrador`);

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
<<<<<<< HEAD
  ADD KEY `fk_notificaciones_administrador` (`id_administrador`),
  ADD KEY `idx_cliente_leido` (`n_identificacion_cliente`,`leido`),
  ADD KEY `idx_fecha_envio` (`fecha_envio`);
=======
  ADD KEY `fk_notificaciones_administrador` (`id_administrador`);
>>>>>>> 14fd044e732d924331039f1d1fabfb86bc048105

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
  ADD UNIQUE KEY `codigoIdentificador_2` (`codigoIdentificador`),
  ADD KEY `fk_productos_claseproducto` (`idClaseProducto`),
  ADD KEY `fk_productos_sexoproducto` (`idSexoProducto`),
  ADD KEY `fk_productos_estadooferta` (`idEstadoOferta`),
  ADD KEY `fk_productos_tipooferta` (`idTipoOferta`),
  ADD KEY `fk_productos_colorproducto` (`idColor`),
  ADD KEY `fk_productos_estadoproducto` (`idEstadoProducto`),
  ADD KEY `fk_productos_administradores` (`id_administrador`),
  ADD KEY `fk_producto_categoria` (`id_categoria`),
  ADD KEY `fk_producto_admin_oferta` (`id_administrador_oferta`);
<<<<<<< HEAD

--
-- Indices de la tabla `reseñas_productos`
--
ALTER TABLE `reseñas_productos`
  ADD PRIMARY KEY (`id_reseña`),
  ADD KEY `n_identificacion_cliente` (`n_identificacion_cliente`),
  ADD KEY `idProducto` (`idProducto`);
=======
>>>>>>> 14fd044e732d924331039f1d1fabfb86bc048105

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
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único del administrador';

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `id_categoria_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `claseproducto`
--
ALTER TABLE `claseproducto`
  MODIFY `idClaseProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colorproducto`
--
ALTER TABLE `colorproducto`
  MODIFY `idColor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cupones_descuento`
--
ALTER TABLE `cupones_descuento`
  MODIFY `id_cupon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cupones_usados`
--
ALTER TABLE `cupones_usados`
  MODIFY `id_cupon_usado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadooferta`
--
ALTER TABLE `estadooferta`
  MODIFY `idEstadoOferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadoproducto`
--
ALTER TABLE `estadoproducto`
  MODIFY `idEstadoProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `favoritos_clientes`
--
ALTER TABLE `favoritos_clientes`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_acciones_clientes`
--
ALTER TABLE `historial_acciones_clientes`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_estados_venta`
--
ALTER TABLE `historial_estados_venta`
  MODIFY `id_historial_estado_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificaciones_admins`
--
ALTER TABLE `notificaciones_admins`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones_clientes`
--
ALTER TABLE `notificaciones_clientes`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_por_categoria`
--
ALTER TABLE `ofertas_por_categoria`
  MODIFY `id_oferta_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reseñas_productos`
--
ALTER TABLE `reseñas_productos`
  MODIFY `id_reseña` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles_administradores`
--
ALTER TABLE `roles_administradores`
  MODIFY `id_rol_admin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único del rol del administrador';

--
-- AUTO_INCREMENT de la tabla `sexoproducto`
--
ALTER TABLE `sexoproducto`
  MODIFY `idSexoProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipooferta`
--
ALTER TABLE `tipooferta`
  MODIFY `idTipoOferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD CONSTRAINT `categoria_producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_productos` (`id_categoria`),
  ADD CONSTRAINT `categoria_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`idProducto`);

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
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`);

--
-- Filtros para la tabla `favoritos_clientes`
--
ALTER TABLE `favoritos_clientes`
  ADD CONSTRAINT `favoritos_clientes_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `favoritos_clientes_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

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
<<<<<<< HEAD
  ADD CONSTRAINT `fk_notificaciones_admin` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`) ON DELETE SET NULL,
=======
>>>>>>> 14fd044e732d924331039f1d1fabfb86bc048105
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
-- Filtros para la tabla `reseñas_productos`
--
ALTER TABLE `reseñas_productos`
  ADD CONSTRAINT `reseñas_productos_ibfk_1` FOREIGN KEY (`n_identificacion_cliente`) REFERENCES `clientes` (`n_identificacion`),
  ADD CONSTRAINT `reseñas_productos_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);
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

