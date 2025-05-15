<head>
    <title>@yield('title', 'Zay_shop')</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="{{ asset('css/distribucion.css') }}">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/estilo0.css">
    <link rel="stylesheet" href="css/letras.css">
    <!--script-->
    <script src="js/sweetalert.js"></script>
    <script src="js/sweet_alerts.js"></script>

</head>

<body>




    <!-- Header -->
    <nav class="navbar navbar-expand-lg h-30 color_navbar shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand  align-self-center" href="">
                ZAY
            </a>
            <div>
                <a id="navbar-toggler" class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#templatemo_main_nav" aria-controls="templatemo_main_nav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <img src="img/menu.svg" alt="Menú" width="40" height="40">

                </a>

            </div>
            <script>
                document.getElementById("navbar-toggler").addEventListener("click", function(event) {
                    event.preventDefault(); // Evita recargar la página

                    const navbar = document.getElementById("templatemo_main_nav");

                    // Alternamos agregando y quitando la clase "active"
                    navbar.classList.toggle("active");
                });
            </script>


            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item align-self-center">
                            <a class="nav-link" href="{{route('productos')}}">INICIO</a>
                        </li>

                        <li class="nav-item align-self-center">
                            <a class="nav-link" href="{{route('productosall')}}">PRODUCTOS</a>
                        </li>

                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <!--Carrito-->
                    <div>
                        <a id="carrito-icon" class="nav-icon position-relative text-decoration-none"
                            href="#IrVentanaFlotante">
                            <!-- <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>-->
                            <img src="img/Shopping_cart.svg" alt="Descripción del icono">
                            <i class="fa-regular fa-cart-shopping"></i>
                            <span id="cantidad-productos"
                                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
                        </a>
                    </div>

                    @include('client.partials.carrito')

                    <div>
                        <a id="user-icon" class="nav-icon position-relative text-decoration-none" href="#">
                            <img src="img/User.svg" alt="Descripción del icono">
                            <i class="fa-regular fa-cart-shopping"></i>
                        </a>
                        <div id="dropdown" class="dropdown-menu">
                            <a href="/cliente/nuevo" class="dropdown-item">Inicio de sesión</a>
                            <a href="/perfil" class="dropdown-item">Perfil</a>
                        </div>
                    </div>
                    <script>
                        document.getElementById('user-icon').addEventListener('click', function(event) {
                            event.preventDefault(); // Evita que el enlace recargue la página
                            const dropdown = document.getElementById('dropdown');
                            dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display ===
                                '' ? 'block' : 'none';

                            // Verificar si la sesión está activa y mostrar/ocultar el enlace "Perfil"
                            const sesionActiva =
                                verificarSesionActiva(); // Llama a una función para verificar sesión
                            const perfilLink = document.getElementById('perfil-link');

                            if (sesionActiva) {
                                perfilLink.style.display = 'block'; // Muestra el enlace "Perfil"
                            } else {
                                perfilLink.style.display = 'none'; // Oculta el enlace "Perfil"
                            }
                        });

                        // Ejemplo de función para verificar sesión activa
                        function verificarSesionActiva() {
                            // Implementa la lógica para verificar una sesión activa
                            // Por ejemplo, verifica una cookie, un token o localStorage
                            return Boolean(localStorage.getItem('none')); // Ejemplo con localStorage
                        }
                    </script>
                    <div>
                        <a id="cierre-icon" class="nav-icon position-relative text-decoration-none" href="#">

                            <img src="img/Icon.svg" alt="Descripción del icono">
                            <i class="fa-regular fa-cart-shopping"></i>
                        </a>
                    </div>
                    <script>
                        document.getElementById('cierre-icon').addEventListener('click', function(event) {
                            event.preventDefault(); // Evita que el enlace recargue la página

                            // Simula la detección de una sesión activa (puedes adaptarlo a tu lógica real)
                            const sesionActiva =
                                verificarSesionActiva(); // Llama a una función para verificar sesión

                            if (sesionActiva) {
                                // Redirige a la vista de cierre de sesión
                                window.location.href = "/cerrar-sesion"; // Cambia la URL según tu configuración
                            } else {
                                // No hacer nada si no hay sesión activa
                                console.log("No hay sesión activa");
                            }
                        });

                        // Ejemplo de una función que verifica una sesión activa
                        //function verificarSesionActiva() {
                        // Aquí podrías implementar tu lógica, como verificar una cookie o una sesión del lado del servidor
                        // return Boolean(localStorage.getItem('usuarioActivo')); // Ejemplo con localStorage
                        //}
                    </script>



                    <!--Nombre y foto de usuario-->


                    @include('client.partials.buscador')


                </div>-
            </div>-
        </div>-

        </div>
    </nav>
    <!-- Close Header -->
    <script type="text/javascript">
        // Variable para almacenar la cantidad de productos
        let cantidadProductos = 0;

        function producto() {


            swal.fire("SE HA AÑADIDO AL CARRITO", "", "success");
            event.preventDefault(); // Previene la recarga de la página

            cantidadProductos++;
            // Actualizar la cantidad en el icono del carrito
            document.getElementById('cantidad-productos').innerText = cantidadProductos;
        }

        function compra() {

            // Verificar si el usuario está registrado
            var usuarioRegistrado = <?php echo json_encode(@$nombre_user_sesion > 0); ?>;

            if (usuarioRegistrado) {

                swal.fire("GRACIAS POR SU COMPRA", "", "success");

                cantidadProductos = 0;
                // Actualizar la cantidad en el icono del carrito
                document.getElementById('cantidad-productos').innerText = cantidadProductos;
            } else {
                // Si el usuario no está registrado, mostrar un mensaje para que inicie sesión
                swal.fire("INICIA SESIÓN PRIMERO", "", "warning");
            }

        }
    </script>