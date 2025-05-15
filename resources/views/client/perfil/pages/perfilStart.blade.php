<!DOCTYPE html>
<html lang="en">


@include('client.partials.header')

<body>
    <section class="container_perfil">
        <!-- Sidebar -->
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
        <!-- Sección de Perfil -->
        <section id="perfil" class="seccion">
            <main class="content col">
                <h1 class="mb-4 text-center">Editar Perfil</h1>
                <form id="formPerfil" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Token de seguridad para formularios en Laravel -->

                    <div class="row">
                        <!-- Nombre -->
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Pérez"
                                required>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="correo@ejemplo.com" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Dirección -->
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                placeholder="Av. Siempre Viva 123" required>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono"
                                placeholder="123-456-7890" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Foto de Perfil -->
                        <div class="col-md-12 mb-3">
                            <label for="foto" class="form-label">Foto de Perfil:</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div>
                    </div>

                    <!-- Botón Guardar -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </main>
        </section>

        <!-- Sección de Compras -->
        <section id="compras" class="seccion text-center" style="display: none;">
            <div class="content">
                <h1 class="text-center">Compras Realizadas</h1>
                <table id="tabla-ventas" class="text-center">
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
            </div>
        </section>

        <!-- Sección de Facturas -->
        <section id="facturas" class="seccion" style="display: none;">
        <table id="tabla-detalles-venta">
            <h1 class="text-center">facturas</h1>
            <thead>
                <tr>
                    
                    <th>ID Venta</th>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('/detalles-venta')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#tabla-detalles-venta tbody");
            tbody.innerHTML = data.map(detalle => `
                <tr>
                    
                    <td>${detalle.id_venta}</td>
                    <td>${detalle.idProducto}</td>
                    <td>${detalle.cantidad_vendida}</td>
                    <td>${detalle.precio_unitario}</td>
                    <td>${detalle.subtotal}</td>
                </tr>
            `).join('');
        });
});
</script>
        </section>
    </section>

    @include('client.partials.footer')
</body>

</html>