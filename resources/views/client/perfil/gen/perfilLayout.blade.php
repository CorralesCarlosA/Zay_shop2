<!-- Start Banner Hero -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->
<!-- la plantilla nno se esta llamando en ningun lado -->

<!DOCTYPE html>
<html lang="en">

@include('client.partials.header')

<section class="container_perfil">
    <nav class="sidebar">
        <div class="usuario">
            <h2>Juan Pérez</h2>
            <div class="linea-verde"></div>
        </div>
        <ul>
            <li><a href="#" class="opcion" onclick="mostrarSeccion('perfil')">Perfil</a></li>
            <li><a href="#" class="opcion" onclick="mostrarSeccion('compras')">Compras</a></li>
            <li><a href="#" class="opcion" onclick="mostrarSeccion('facturas')">Facturas</a></li>
        </ul>
    </nav>

    <section id="perfil" class="seccion">
        <div class="container_ver">
            <h1>Editar Perfil</h1>
            <main class="content">
                <section id="perfil">
                    <h1>Editar Perfil</h1>
                    <form id="formPerfil">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Juan Pérez">

                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com">

                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Av. Siempre Viva 123">

                        <button type="submit">Guardar</button>
                    </form>
                </section>
            </main>
        </div>

        <!-- Formulario -->
    </section>
    <section id="compras" class="seccion" style="display: none;">
        <h1>Compras Realizadas</h1>
        <table id="tabla-ventas">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Método de Pago</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('/ventas')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#tabla-ventas tbody");
            tbody.innerHTML = data.map(venta => `
                <tr>
                    <td>${venta.id_venta}</td>
                    <td>${venta.fecha_venta}</td>
                    <td>${venta.total_venta}</td>
                    <td>${venta.estado_venta}</td>
                    <td>${venta.metodo_pago}</td>
                </tr>
            `).join('');
        });
});
</script>
        <!-- Contenido -->
    </section>
    <section id="facturas" class="seccion" style="display: none;">
        <h1>Facturas Guardadas</h1>
        <!-- Contenido -->
    </section>

</section>


@yield('informacion_perfil')

@include('client.partials.footer')


</body>

</html>