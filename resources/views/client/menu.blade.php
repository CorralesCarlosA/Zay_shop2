<!-- Start Banner Hero -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="css/estilo0.css">
    <link rel="stylesheet" href="css/letras.css">
    <!--script-->
    <script src="js/sweetalert.js"></script>
    <script src="js/sweet_alerts.js"></script>

</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="menulog">
                <img src="img/logo.png" alt="">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a style="margin-left: 250px" class="nav-link" href="{{route('menulog')}}">INICIO</a>
                        </li>

                        <li class="nav-item">
                            <a style="margin-left: 350px; margin-top: -40px; " class="nav-link"
                                href="{{route('menulog')}}">PRODUCTOS</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <!--Carrito-->
                    <div>
                        <a id="carrito-icon" class="nav-icon position-relative text-decoration-none"
                            href="#IrVentanaFlotante">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span id="cantidad-productos"
                                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
                        </a>
                    </div>


                    <div id="IrVentanaFlotante" class="vtn">
                        <div class="ventana">
                            <a href="#" style='text-decoration:none; color:red;'>X</a>


                            <!-- Carrito -->
                            <section class="shopping-cart">
                                <div class="container">
                                    <h1 class="text-center" style="color: #FF5733; font-size: 36px;">
                                        Mi Carrito de
                                        Compras</h1>
                                    <hr style="border-top: 2px solid #FF5733;">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="shopping-cart-header">
                                                <h6>Producto</h6>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="shopping-cart-header">
                                                <h6 class="text-truncate">
                                                    Precio</h6>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="shopping-cart-header">
                                                <h6>Cantidad</h6>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="shopping-cart-header">
                                                <h6>Eliminar</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tamaño" class="shopping-cart-items shoppingCartItemsContainer">
                                    </div>

                                    <!-- TOTAL -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="shopping-cart-total d-flex align-items-center">
                                                <p class="mb-0" style="color: #FF5733; font-size: 24px;">
                                                    TOTAL:</p>
                                                <p class="ml-4 mb-0 shoppingCartTotal"
                                                    style="color: #000; font-size: 24px;">
                                                    $0</p>
                                                <div class="toast ml-auto bg-info" role="alert" aria-live="assertive"
                                                    aria-atomic="true" data-delay="2000">
                                                </div>
                                                <br><br><br>
                                                <div class="btn-container-wrapper">
                                                    <div class="btn-container">
                                                        <button class="btn btn-success comprarButton" type="button"
                                                            data-toggle="modal" data-target="#comprarModal"
                                                            onclick="compra()">Comprar</button>
                                                        <button class="btn btn-success" type="button"
                                                            data-toggle="modal" onclick="mostrarFactura()">Generar
                                                            Factura</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- FACTURA -->
                            <div class="factura" id="miFactura">
                                <button onclick="cerrarFactura()"
                                    style="position: absolute; top: -5px; right: -5px; background-color: transparent; color: red; border: none; font-size: 15px; padding: 5px 10px; border-radius: 50%; cursor: pointer;">X</button>
                                <h2 style="color: #FF5733; font-size: 28px;">
                                    Factura de Compra</h2>
                                <p style="font-size: 18px;">Cliente:
                                    <?php echo @$nombre_user_sesion; ?>
                                </p>
                                <table style="width: 100%; margin-top: 20px;">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                    </tr>
                                    <tbody id="carritoFactura">
                                        <!-- Aquí se agregarán las filas de la factura -->
                                    </tbody>
                                </table>
                                <p style="font-size: 18px; margin-top: 20px;">
                                    Total: <span id="totalCompra" style="color: #FF5733;">$0.00</span>
                                </p>
                                <center><button id="imprimirBtn" onclick="imprimirFactura()">Imprimir
                                        Factura</button>
                                </center>
                            </div>
                        </div>
                    </div>

                    <style>
                    #tamaño {
                        overflow-y: auto;
                        max-height: 300px;
                    }

                    .ventana {
                        background-color: white;
                        width: 80%;
                        padding: 10px 20px;
                        border-radius: 20px;
                        margin: 20% auto;
                        position: relative;
                        top: 50px;
                    }

                    .vtn {
                        background-color: rgba(0, 0, 0, .8);
                        position: fixed;
                        top: -250px;
                        right: 0;
                        bottom: 0;
                        left: 0;
                        opacity: 0;
                        pointer-events: none;
                        transition: all 1s;
                        z-index: 1000;
                    }

                    #IrVentanaFlotante:target {
                        opacity: 1;
                        pointer-events: auto;
                    }
                    </style>

                    <!--Nombre y foto de usuario-->
                    <?php $nombre_user_sesion = session('nombre_user_sesion'); ?>
                    <?php if ($nombre_user_sesion) : ?>
                    <div class="user" data-toggle="dropdown" role="button">
                        <a class="nav-item nav-link active">BIENVENIDO:
                            <?php echo @$nombre_user_sesion; ?></a>
                    </div>
                    <?php endif; ?>
                    <!--menu de salir-->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                        <a class="nav-link" href="{{route('productos')}}">Cerrar
                            sesión</a>
                    </div>

                    <!--Buscar en el buscador-->

                    <!-- Buscador -->
                    <form class="form" method="post">
                        <input class="input" id="productoBuscado" placeholder="Buscar" oninput="buscarProducto()">
                        <button onclick="return false" class="button"><i
                                class="fa fa-fw fa-search text-dark mr-2"></i></button>
                    </form>
                    <!--Buscar en el buscador-->
                    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="w-100 pt-1 mb-5 text-right">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="inputModalSearch" name="q"
                                        placeholder="Search ...">
                                    <button type="submit" class="input-group-text bg-success text-light">
                                        <i class="fa fa-fw fa-search text-white"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                    function buscarProducto() {
                        var input, filter, productos, producto, i,
                            txtValue;
                        input = document.getElementById(
                            'productoBuscado');
                        filter = input.value.toUpperCase();
                        productos = document.getElementById(
                            'productos');
                        producto = productos.getElementsByClassName(
                            'producto');

                        for (i = 0; i < producto.length; i++) {
                            txtValue = producto[i].textContent ||
                                producto[i].innerText;
                            if (txtValue.toUpperCase().indexOf(
                                    filter) > -1) {
                                producto[i].style.display = '';
                            } else {
                                producto[i].style.display = 'none';
                            }
                        }
                    }
                    </script>


                    <style>
                    .form {
                        display: flex;
                        margin: 10px;
                    }

                    .input[name="Buscar"] {
                        padding: 5px;
                        flex: 1;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        width: 100px;
                    }

                    .button {
                        padding: 5px 10px;
                        background-color: green;
                        border: none;
                    }
                    </style>

                </div>
            </div>
        </div>

        </div>
    </nav>
    <!-- Close Header -->

    <script type="text/javascript">
    // Variable para almacenar la cantidad de productos
    let cantidadProductos = 0;

    function producto() {

        swal.fire("SE HA AÑADIDO AL CARRITO", "", "success");
        cantidadProductos++;
        // Actualizar la cantidad en el icono del carrito
        document.getElementById('cantidad-productos').innerText =
            cantidadProductos;
    }

    function compra() {

        // Verificar si el usuario está registrado
        var usuarioRegistrado =
            <?php echo json_encode(@$nombre_user_sesion > 0); ?>;

        if (usuarioRegistrado) {

            swal.fire("GRACIAS POR SU COMPRA", "", "success");

            cantidadProductos = 0;
            // Actualizar la cantidad en el icono del carrito
            document.getElementById('cantidad-productos').innerText =
                cantidadProductos;
        } else {
            // Si el usuario no está registrado, mostrar un mensaje para que inicie sesión
            swal.fire("INICIA SESIÓN PRIMERO", "", "warning");
        }

    }
    </script>



    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="img/banner_img_01.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success">
                                    <b>Zay</b> Shop
                                </h1>
                                <h3 class="h2">Zapato white black
                                </h3>
                                <p>
                                    Los zapatos blancos son un tipo
                                    de calzado que se caracteriza por
                                    su color blanco en
                                    su mayoría. Son populares en
                                    diversas ocasiones, como bodas,
                                    eventos formales,
                                    deportes, y también en el ámbito
                                    de la moda casual.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="img/banner_img_02.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Desodorante Curologyt
                                </h1>
                                <p>
                                    Curology es una marca de cuidado
                                    de la piel que ofrece productos
                                    personalizados para
                                    el cuidado de la piel.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="img/banner_img_03.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Lámpara</h1>
                                <p>
                                    Una lámpara es un dispositivo que
                                    genera luz mediante una fuente de
                                    iluminación,
                                    como una bombilla o una fuente de
                                    luz LED, y puede utilizarse para
                                    iluminar un
                                    espacio o como un elemento
                                    decorativo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
                role="button" data-bs-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
                role="button" data-bs-slide="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
        <!-- End Banner Hero -->


        <!-- Start Categories of The Month -->
        <section class="container py-5">
            <div class="row text-center pt-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Productos De Zay Shop</h1>
                    <p>

                    </p>
                </div>
            </div>
            <div id="productos">
                <div class="row">

                    <div class="col-12 col-md-4 p-5 mt-3">
                        <div class="producto" id="producto1">
                            <div class="item mb-4">
                                <a href="#"><img src="img/category_img_01.jpg"
                                        class="item-image rounded-circle img-fluid border"></a>
                                <h5 class="text-center mt-3 mb-3 item-title">
                                    Relog</h5>
                                <p class="text-center item-details">
                                <h4 class="item-price">$54000</h4>
                                <button onclick="producto()" class="btn btn-success addToCart">Añadir
                                    al
                                    carrito</button></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 p-5 mt-3">
                        <div class="producto" id="producto1">
                            <div class="item mb-4">
                                <a href="#"><img src="img/category_img_02.jpg"
                                        class="item-image rounded-circle img-fluid border"></a>
                                <h5 class="text-center mt-3 mb-3 item-title">
                                    Zapatos nike</h5>
                                <p class="text-center item-details">
                                <h4 class="item-price">$43000</h4>
                                <button onclick="producto()" class="btn btn-success addToCart">Añadir
                                    al
                                    carrito</button></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 p-5 mt-3">
                        <div class="producto" id="producto1">
                            <div class="item mb-4">
                                <a href="#"><img src="img/category_img_03.jpg"
                                        class="item-image rounded-circle img-fluid border"></a>
                                <h5 class="text-center mt-3 mb-3 item-title">
                                    Gafas</h5>
                                <p class="text-center item-details">
                                <h4 class="item-price">$54000</h4>
                                <button onclick="producto()" class="btn btn-success addToCart">Añadir
                                    al
                                    carrito</button></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 p-5 mt-3">
                        <div class="producto" id="producto1">
                            <div class="item mb-4">
                                <a href="#"><img src="img/category_img_04.jpg"
                                        class="item-image rounded-circle img-fluid border"></a>
                                <h5 class="text-center mt-3 mb-3 item-title">
                                    Linterna</h5>
                                <p class="text-center item-details">
                                <h4 class="item-price">$34000</h4>
                                <button onclick="producto()" class="btn btn-success addToCart">Añadir
                                    al
                                    carrito</button></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 p-5 mt-3">
                        <div class="producto" id="producto1">
                            <div class="item mb-4">
                                <a href="#"><img src="img/category_img_05.jpg"
                                        class="item-image rounded-circle img-fluid border"></a>
                                <h5 class="text-center mt-3 mb-3 item-title">
                                    Relog red</h5>
                                <p class="text-center item-details">
                                <h4 class="item-price">$13000</h4>
                                <button onclick="producto()" class="btn btn-success addToCart">Añadir
                                    al
                                    carrito</button></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 p-5 mt-3">
                        <div class="producto" id="producto1">
                            <div class="item mb-4">
                                <a href="#"><img src="./img/category_img_06.jpg"
                                        class="item-image rounded-circle img-fluid border"></a>
                                <h5 class="text-center mt-3 mb-3 item-title">
                                    Camara</h5>
                                <p class="text-center item-details">
                                <h4 class="item-price">$14000</h4>
                                <button onclick="producto()" class="btn btn-success addToCart">Añadir
                                    al
                                    carrito</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Categories of The Month -->

        <script type="text/javascript">
        document.getElementById('contact-form').addEventListener(
            'submit',
            function(e) {
                e.preventDefault();

                // Obtenemos los valores del formulario
                const nombre = document.getElementById('nombre')
                    .value;
                const correo = document.getElementById('correo')
                    .value;
                const mensaje = document.getElementById(
                    'mensaje').value;

                // Crear el enlace 'mailto' con los datos del formulario
                const mailtoLink =
                    `mailto:pp@gmail.com?subject=Contacto&body=Nombre: ${nombre}%0AEmail: ${correo}%0AMensaje: ${mensaje}`;

                // Redirigir al usuario al cliente de correo
                window.location.href = mailtoLink;

                // Muestra el mensaje "Correo enviado"
                document.getElementById('mensaje-enviado')
                    .textContent = 'Correo enviado';
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
        <script src="js/añadir.js"></script>



        <!-- Start Footer -->
        <footer class="bg-dark" id="tempaltemo_footer">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 pt-5">
                        <h2 class="h2 text-success border-bottom pb-3 border-light logo">
                            Zay Shop</h2>
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
                        <h2 class="h2 text-light border-bottom pb-3 border-light">
                            Menu</h2>
                        <ul class="list-unstyled text-light footer-link-list">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('menulog')}}">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('menulog')}}">Productos</a>
                            </li>


                        </ul>
                    </div>

                </div>

                <div class="row text-light mb-4">
                    <div class="col-12 mb-3">
                        <div class="w-100 my-3 border-top border-light">
                        </div>
                    </div>
                    <div class="col-auto me-auto">
                        <ul class="list-inline text-left footer-icons">
                            <li class="list-inline-item border border-light rounded-circle text-center">
                                <a class="text-light text-decoration-none" target="_blank"
                                    href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                            </li>
                            <li class="list-inline-item border border-light rounded-circle text-center">
                                <a class="text-light text-decoration-none" target="_blank"
                                    href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                            </li>
                            <li class="list-inline-item border border-light rounded-circle text-center">
                                <a class="text-light text-decoration-none" target="_blank"
                                    href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                            </li>
                            <li class="list-inline-item border border-light rounded-circle text-center">
                                <a class="text-light text-decoration-none" target="_blank"
                                    href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
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
        <script src="public/js/foto_move.js"></script>
        <!-- End Script -->
        <script src="frontend/js/foto_move.js"></script>
        <!--Scrips para desplegar el munu de seccion-->

        <script src="frontend/plantilla/vendor/jquery/jquery.min.js">
        </script>
        <script src="frontend/plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js">
        </script>

        <!-- End Categories of The Month 
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
    </style>-->
</body>

</html>