
<!-- Start Banner Hero -->
<!DOCTYPE html>
<html lang="en">




 
@include('client.partials.header')

<section class="container py-5">
    <div class="row">
        <!-- Filtros de categorías -->
        <aside class="col-12 col-md-3">
            <h4 style="color: #02542D;" class="text-center">Categorías</h4>
            <ul class="list-group text-center">
                <li class="list-group-item"><a href="#">Zapatos</a></li>
                <li class="list-group-item"><a href="#">Gorras</a></li>
                <li class="list-group-item"><a href="#">Ropa</a></li>
                <li class="list-group-item"><a href="#">Accesorios</a></li>
            </ul>
        </aside>

        <!-- Productos -->
        <div class="col-12 col-md-9">
            
            <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/zapatos.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >Zapatos</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$54000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>
            </div>
        </div>
        </div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/gorra.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >gorra</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$43000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/camibuso.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >camibuso</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$54000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>
            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/busorosa.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >buso pink</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$34000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/busonegro.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >buso dark</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$13000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/busoamarillo.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >buso yellow</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$14000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div></div>
        </div>
            </div>
        </div>
    </div>
</section>

<!-- Start Banner Hero -->

    <!-- End Banner Hero -->


    <!-- Start Categories of The Month 
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto ">
                <h1 class="h1">PRODUCTOS DESTACADOS</h1>
                <p>
                   
                </p>
            </div>
        </div>
          <div id="productos">
        <div class="row">

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/zapatos.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >Zapatos</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$54000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>
            </div>
        </div>
        </div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/gorra.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >gorra</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$43000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/camibuso.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >camibuso</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$54000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>
            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/busorosa.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >buso pink</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$34000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/busonegro.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >buso dark</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$13000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div>
        </div></div>

        <div class="col-12 col-md-4 p-5 mt-3"><div class="producto" id="producto1">
            <div class="item mb-4 text-center">
                <a href="#"><img src="img/busoamarillo.png" class="item-image rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3 item-title" >buso yellow</h5>
                <div class="text-center item-details ">
                    <h4 class="btn btn-success item-price">$14000</h4>
                    <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                </div>

            </div></div>
        </div>
        </div>
        </div>
    </section>-->
    <!-- End Categories of The Month -->
    <script type="text/javascript">
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Obtenemos los valores del formulario
            const nombre = document.getElementById('nombre').value;
            const correo = document.getElementById('correo').value;
            const mensaje = document.getElementById('mensaje').value;

            // Crear el enlace 'mailto' con los datos del formulario
            const mailtoLink =
                `mailto:pp@gmail.com?subject=Contacto&body=Nombre: ${nombre}%0AEmail: ${correo}%0AMensaje: ${mensaje}`;

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
            color: #B78732;
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
    <script src="js/añadir.js"></script>
    @include('client.partials.footer')


    </body>

    </html>