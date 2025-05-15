e.preventDefault();

// Obtenemos los valores del formulario
const nombre = document.getElementById('nombre').value;
const correo = document.getElementById('correo').value;
const mensaje = document.getElementById('mensaje').value;

// Crear el enlace 'mailto' con los datos del formulario
const mailtoLink = `mailto:pp@gmail.com?subject=Contacto&body=Nombre: ${nombre}%0AEmail: ${correo}%0AMensaje:
${mensaje}`;

// Redirigir al usuario al cliente de correo
window.location.href = mailtoLink;

// Muestra el mensaje "Correo enviado"
document.getElementById('mensaje-enviado').textContent = 'Correo enviado';
});


</script>


<style type="text/css">
#contact-form {
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 20px;
}

h1 {
    color: #007bff;
}

.form-group {
    margin: 10px 0;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input,
textarea {
    width: 30%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

.button2 {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

#mensaje-enviado {
    margin-top: 20px;
    color: green;
    font-weight: bold;
}
</style>

<!--script para añadir producto al carrito-->
<script src="<?Php echo base_url().'frontend/js/añadir.js'; ?>"></script>



<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zay Shop</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        FUCLA
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:info@company.com">EVIN@GMAIL.com</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Usuario</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('registro')}}">Crear Cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('sesion')}}">Iniciar Sesion</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Menu</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('productos')}}">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('productos')}}">Productos</a>
                    </li>


                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i
                                class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i
                                class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">

                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->

<!-- Start Script -->
<script src="frontend/js/foto_move.js"></script>
<!-- End Script -->

<!--Scrips para desplegar el munu de seccion-->

<script src="<?php echo base_url();?>frontend/plantilla/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>frontend/plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>