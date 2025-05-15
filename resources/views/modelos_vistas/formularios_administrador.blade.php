<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h5>gestionar clientes</h5>
    <form action="/admin/gestionar-cliente" method="POST">
        @csrf
        <h3>Gestionar Cliente</h3>

        <!-- Número de identificación (clave primaria) -->
        <label for="n_identificacion">Número de Identificación:</label>
        <input type="text" id="n_identificacion" name="n_identificacion" required pattern="\d{8,15}" readonly>

        <!-- Datos personales -->
        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+">

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+">

        <!-- Tipo de identificación -->
        <label for="tipo_identificacion">Tipo de Identificación:</label>
        <select id="tipo_identificacion" name="tipo_identificacion" required>
            <option value="Cedula de ciudadania (CC)">Cédula de Ciudadanía</option>
            <option value="Tarjeta de identidad (TI)">Tarjeta de Identidad</option>
            <option value="NIT">NIT</option>
        </select>

        <!-- Sexo -->
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>

        <!-- Estatura -->
        <label for="estatura">Estatura (en metros):</label>
        <input type="number" step="0.01" min="0.5" max="2.5" id="estatura" name="estatura">

        <!-- Contacto -->
        <label for="correoE">Correo Electrónico:</label>
        <input type="email" id="correoE" name="correoE" required>

        <label for="n_telefono">Teléfono (con código de país):</label>
        <input type="tel" id="n_telefono" name="n_telefono" required pattern="\+\d{10,15}">

        <label for="Direccion_recidencia">Dirección de Residencia:</label>
        <input type="text" id="Direccion_recidencia" name="Direccion_recidencia" required>

        <!-- Ciudad -->
        <label for="ciudad">Ciudad:</label>
        <select id="ciudad" name="ciudad" required>
            @foreach ($ciudades as $ciudad)
            <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
            @endforeach
        </select>

        <!-- Estado del cliente -->
        <label for="estado_cliente">Estado del Cliente:</label>
        <select id="estado_cliente" name="estado_cliente" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button type="submit">Actualizar Cliente</button>
    </form>

    <h5>agregar/editar pedidos</h5>

    <form action="/admin/productos" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Agregar/Editar Producto</h3>

        <!-- Nombre del producto -->
        <label for="nombreProducto">Nombre del Producto:</label>
        <input type="text" id="nombreProducto" name="nombreProducto" required>

        <!-- Precio -->
        <label for="precioProducto">Precio:</label>
        <input type="number" step="0.01" id="precioProducto" name="precioProducto" required>

        <!-- Talla -->
        <label for="tallaProducto">Talla:</label>
        <input type="text" id="tallaProducto" name="tallaProducto">

        <!-- Clase de producto -->
        <label for="idClaseProducto">Clase de Producto:</label>
        <select id="idClaseProducto" name="idClaseProducto" required>
            @foreach ($clases as $clase)
            <option value="{{ $clase->idClaseProducto }}">{{ $clase->nombreClase }}</option>
            @endforeach
        </select>

        <!-- Sexo del producto -->
        <label for="idSexoProducto">Sexo del Producto:</label>
        <select id="idSexoProducto" name="idSexoProducto" required>
            @foreach ($sexos as $sexo)
            <option value="{{ $sexo->idSexoProducto }}">{{ $sexo->nombreSexo }}</option>
            @endforeach
        </select>

        <!-- Color -->
        <label for="idColor">Color:</label>
        <select id="idColor" name="idColor" required>
            @foreach ($colores as $color)
            <option value="{{ $color->idColor }}">{{ $color->nombreColor }}</option>
            @endforeach
        </select>

        <!-- Cantidad disponible -->
        <label for="cantidadDisponible">Cantidad Disponible:</label>
        <input type="number" id="cantidadDisponible" name="cantidadDisponible" required>

        <!-- Descripción -->
        <label for="descripcionProducto">Descripción:</label>
        <textarea id="descripcionProducto" name="descripcionProducto" rows="4"></textarea>

        <!-- Código identificador -->
        <label for="codigoIdentificador">Código Identificador:</label>
        <input type="text" id="codigoIdentificador" name="codigoIdentificador" required>

        <!-- Categoría -->
        <label for="id_categoria">Categoría:</label>
        <select id="id_categoria" name="id_categoria" required>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
            @endforeach
        </select>

        <!-- Estado del producto -->
        <label for="idEstadoProducto">Estado del Producto:</label>
        <select id="idEstadoProducto" name="idEstadoProducto" required>
            @foreach ($estadosProducto as $estado)
            <option value="{{ $estado->idEstadoProducto }}">{{ $estado->estado }}</option>
            @endforeach
        </select>

        <!-- Imágenes -->
        <label for="imagenes">Imágenes del Producto:</label>
        <input type="file" id="imagenes" name="imagenes[]" multiple accept="image/*">

        <button type="submit">Guardar Producto</button>
    </form>

    <h5>gestionar pedidos</h5>
    <form action="/admin/pedidos" method="POST">
        @csrf
        <h3>Gestionar Pedido</h3>

        <!-- Cliente -->
        <label for="n_identificacion_cliente">Cliente:</label>
        <select id="n_identificacion_cliente" name="n_identificacion_cliente" required>
            @foreach ($clientes as $cliente)
            <option value="{{ $cliente->n_identificacion }}">{{ $cliente->nombres }} {{ $cliente->apellidos }}</option>
            @endforeach
        </select>

        <!-- Dirección de envío -->
        <label for="direccion_envio">Dirección de Envío:</label>
        <input type="text" id="direccion_envio" name="direccion_envio" required>

        <!-- Ciudad de envío -->
        <label for="ciudad_envio">Ciudad de Envío:</label>
        <select id="ciudad_envio" name="ciudad_envio" required>
            @foreach ($ciudades as $ciudad)
            <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
            @endforeach
        </select>

        <!-- Estado del pedido -->
        <label for="estado_pedido">Estado del Pedido:</label>
        <select id="estado_pedido" name="estado_pedido" required>
            <option value="En proceso">En Proceso</option>
            <option value="Enviado">Enviado</option>
            <option value="Entregado">Entregado</option>
            <option value="Cancelado">Cancelado</option>
        </select>

        <!-- Productos -->
        <label for="productos">Productos:</label>
        <div id="productos">
            <div class="producto-row">
                <select name="idProducto[]" required>
                    @foreach ($productos as $producto)
                    <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                    @endforeach
                </select>
                <input type="number" name="cantidad_pedido[]" min="1" required>
            </div>
        </div>
        <button type="button" onclick="agregarProducto()">Agregar Otro Producto</button>

        <button type="submit">Guardar Pedido</button>
    </form>

    <script>
    function agregarProducto() {
        const container = document.getElementById('productos');
        const row = document.createElement('div');
        row.className = 'producto-row';
        row.innerHTML = `
    <select name="idProducto[]" required>
      @foreach ($productos as $producto)
        <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
      @endforeach
    </select>
    <input type="number" name="cantidad_pedido[]" min="1" required>
  `;
        container.appendChild(row);
    }
    </script>

    <h5>crear cupnes de descuento</h5>

    <form action="/admin/cupones" method="POST">
        @csrf
        <h3>Crear Cupón de Descuento</h3>

        <!-- Código del cupón -->
        <label for="codigo_cupon">Código del Cupón:</label>
        <input type="text" id="codigo_cupon" name="codigo_cupon" required>

        <!-- Tipo de descuento -->
        <label for="tipo_descuento">Tipo de Descuento:</label>
        <select id="tipo_descuento" name="tipo_descuento" required>
            <option value="Porcentaje">Porcentaje</option>
            <option value="Valor fijo">Valor Fijo</option>
        </select>

        <!-- Valor del descuento -->
        <label for="valor">Valor del Descuento:</label>
        <input type="number" step="0.01" id="valor" name="valor" required>

        <!-- Fecha de expiración -->
        <label for="fecha_expiracion">Fecha de Expiración:</label>
        <input type="date" id="fecha_expiracion" name="fecha_expiracion" required>

        <!-- Estado -->
        <label for="activo">Estado:</label>
        <select id="activo" name="activo" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button type="submit">Crear Cupón</button>
    </form>

    <h5>enviar notifficacion
        <form action="/admin/notificaciones" method="POST">
            @csrf
            <h3>Enviar Notificación a Cliente</h3>

            <!-- Cliente -->
            <label for="n_identificacion_cliente">Cliente:</label>
            <select id="n_identificacion_cliente" name="n_identificacion_cliente" required>
                @foreach ($clientes as $cliente)
                <option value="{{ $cliente->n_identificacion }}">{{ $cliente->nombres }} {{ $cliente->apellidos }}
                </option>
                @endforeach
            </select>

            <!-- Título -->
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <!-- Mensaje -->
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <!-- Tipo de notificación -->
            <label for="tipo_notificacion">Tipo de Notificación:</label>
            <select id="tipo_notificacion" name="tipo_notificacion" required>
                <option value="Promoción">Promoción</option>
                <option value="Descuento">Descuento</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Mensaje personal">Mensaje Personal</option>
                <option value="Recordatorio">Recordatorio</option>
                <option value="Otro">Otro</option>
            </select>

            <!-- Importante -->
            <label for="importante">¿Importante?</label>
            <select id="importante" name="importante">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>

            <button type="submit">Enviar Notificación</button>
        </form>

        <h5>gestionar inventario</h5>
        <form action="/admin/inventario" method="POST">
            @csrf
            <h3>Gestionar Inventario</h3>

            <!-- Producto -->
            <label for="idProducto">Producto:</label>
            <select id="idProducto" name="idProducto" required>
                @foreach ($productos as $producto)
                <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                @endforeach
            </select>

            <!-- Stock actual -->
            <label for="stock_actual">Stock Actual:</label>
            <input type="number" id="stock_actual" name="stock_actual" required>

            <!-- Stock mínimo -->
            <label for="stock_minimo">Stock Mínimo:</label>
            <input type="number" id="stock_minimo" name="stock_minimo" required>

            <button type="submit">Actualizar Inventario</button>
        </form>



</body>

</html>