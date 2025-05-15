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
    <h5>formulario de registro de registro de usuario</h5>
    <form action="/registro-cliente" method="POST">
        @csrf
        <h3>Datos Personales</h3>

        <!-- Nombres -->
        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+">

        <!-- Apellidos -->
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+">

        <!-- Tipo de identificación -->
        <label for="tipo_identificacion">Tipo de Identificación:</label>
        <select id="tipo_identificacion" name="tipo_identificacion" required>
            <option value="Cedula de ciudadania (CC)">Cédula de Ciudadanía</option>
            <option value="Tarjeta de identidad (TI)">Tarjeta de Identidad</option>
            <option value="NIT">NIT</option>
        </select>

        <!-- Número de identificación -->
        <label for="n_identificacion">Número de Identificación:</label>
        <input type="text" id="n_identificacion" name="n_identificacion" required pattern="\d{8,15}">

        <!-- Sexo -->
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>

        <!-- Estatura -->
        <label for="estatura">Estatura (en metros):</label>
        <input type="number" step="0.01" min="0.5" max="2.5" id="estatura" name="estatura" required>

        <!-- Fecha de registro (automático en BD) -->
        <input type="hidden" name="fecha_registro" value="{{ now() }}">

        <!-- Contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required minlength="8">

        <!-- Confirmación de contraseña -->
        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <h3>Contacto</h3>
        <!-- Correo electrónico -->
        <label for="correoE">Correo Electrónico:</label>
        <input type="email" id="correoE" name="correoE" required>

        <!-- Teléfono -->
        <label for="n_telefono">Teléfono (con código de país):</label>
        <input type="tel" id="n_telefono" name="n_telefono" required pattern="\+\d{10,15}">

        <!-- Dirección -->
        <label for="Direccion_recidencia">Dirección de Residencia:</label>
        <input type="text" id="Direccion_recidencia" name="Direccion_recidencia" required>

        <!-- Ciudad (relación con tabla ciudades) -->
        <label for="ciudad">Ciudad:</label>
        <select id="ciudad" name="ciudad" required>
            <!-- Opciones dinámicas desde la tabla ciudades -->
            @foreach ($ciudades as $ciudad)
            <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
            @endforeach
        </select>

        <button type="submit">Registrar Cliente</button>
    </form>

    <h5>agregar a favoritos</h5>
    <form action="/agregar-favorito" method="POST">
        @csrf
        <label for="n_identificacion_cliente">Número de Identificación:</label>
        <input type="text" id="n_identificacion_cliente" name="n_identificacion_cliente" required pattern="\d{8,15}">

        <label for="idProducto">Producto:</label>
        <select id="idProducto" name="idProducto" required>
            <!-- Opciones dinámicas desde productos -->
            @foreach ($productos as $producto)
            <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
            @endforeach
        </select>

        <button type="submit">Agregar a Favoritos</button>
    </form>

    <h5>mensajes de soporte al cliente</h5>
    <form action="/enviar-mensaje" method="POST">
        @csrf
        <label for="n_identificacion_cliente">Número de Identificación:</label>
        <input type="text" id="n_identificacion_cliente" name="n_identificacion_cliente" required pattern="\d{8,15}">

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

        <button type="submit">Enviar Mensaje</button>
    </form>

    <h5>calificaciones y resenas</h5>
    <form action="/agregar-reseña" method="POST">
        @csrf
        <label for="n_identificacion_cliente">Número de Identificación:</label>
        <input type="text" id="n_identificacion_cliente" name="n_identificacion_cliente" required pattern="\d{8,15}">

        <label for="idProducto">Producto:</label>
        <select id="idProducto" name="idProducto" required>
            <!-- Opciones dinámicas desde productos -->
            @foreach ($productos as $producto)
            <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
            @endforeach
        </select>

        <label for="calificacion">Calificación (1-5):</label>
        <input type="number" id="calificacion" name="calificacion" min="1" max="5" required>

        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" rows="4"></textarea>

        <button type="submit">Enviar Reseña</button>
    </form>


</body>

</html>