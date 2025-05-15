<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   

    <link rel="stylesheet" href="{{ asset('frontend/css/estilo0.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/letras.css') }}">

    <!--script-->
    <script src="{{ asset('frontend/js/sweetalert.js') }}"></script>

    <script src="{{ asset('frontend/js/sweet_alerts.js') }}"></script>


</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="mostrar-productos">
                Zay
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('productos')}}">INICIO</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" href="{{route('productos')}}">PRODUCTOS</a>
                        </li>
                     
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('registro')}}">CREAR CUENTA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('sesion')}}">INICIAR SESION</a>
                        </li>
                    </ul>
                </div>
            <div class="navbar align-self-center d-flex">
<!--Carrito-->
<div> 
    <a id="carrito-icon" class="nav-icon position-relative text-decoration-none" href="#IrVentanaFlotante">
        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
        <span id="cantidad-productos" class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
    </a>
</div>

                   
<div id="IrVentanaFlotante" class="vtn">
  <div class="ventana">
    <a href="#" style='text-decoration:none; color:red;'>X</a>
    

<!-- Carrito -->
<section class="shopping-cart">
    <div class="container">
        <h1 class="text-center" style="color: #FF5733; font-size: 36px;">Mi Carrito de Compras</h1>
        <hr style="border-top: 2px solid #FF5733;">
        <div class="row">
            <div class="col-4">
                <div class="shopping-cart-header">
                    <h6>Producto</h6>
                </div>
            </div>
            <div class="col-2">
                <div class="shopping-cart-header">
                    <h6 class="text-truncate">Precio</h6>
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
        <div id="tamaño" class="shopping-cart-items shoppingCartItemsContainer"></div>

        <!-- TOTAL -->
        <div class="row">
            <div class="col-12">
                <div class="shopping-cart-total d-flex align-items-center">
                    <p class="mb-0" style="color: #FF5733; font-size: 24px;">TOTAL:</p>
                    <p class="ml-4 mb-0 shoppingCartTotal" style="color: #000; font-size: 24px;">$0</p>
                    <div class="toast ml-auto bg-info" role="alert" aria-live="assertive" aria-atomic="true"
                        data-delay="2000">
                    </div>
                    <br><br><br>
                   <div class="btn-container-wrapper">
    <div class="btn-container">
        <button class="btn btn-success comprarButton" type="button" data-toggle="modal" data-target="#comprarModal" onclick="compra()">Comprar</button>
        <button class="btn btn-success" type="button" data-toggle="modal" onclick="mostrarFactura()">Generar Factura</button>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- FACTURA -->
<div class="factura" id="miFactura">
    <button onclick="cerrarFactura()" style="position: absolute; top: -5px; right: -5px; background-color: transparent; color: red; border: none; font-size: 15px; padding: 5px 10px; border-radius: 50%; cursor: pointer;">X</button>
    <h2 style="color: #FF5733; font-size: 28px;">Factura de Compra</h2>
    <p style="font-size: 18px;">Cliente: <?php echo @$nombre_user_sesion; ?></p>
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
    <p style="font-size: 18px; margin-top: 20px;">Total: <span id="totalCompra" style="color: #FF5733;">$0.00</span></p>
    <center><button id="imprimirBtn" onclick="imprimirFactura()">Imprimir Factura</button></center>
</div>
  </div>  
</div>

<style>
    #tamaño {
    overflow-y: auto; 
    max-height: 300px; 
}
.ventana{
  background-color:white;
  width:80%;
  padding: 10px 20px;
  border-radius: 20px;
  margin: 20% auto;
  position: relative;
  top:50px;
}
.vtn{
  background-color: rgba(0,0,0,.8);
  position:fixed;
  top:-250px;
  right:0;
  bottom:0;
  left:0;
  opacity:0;
  pointer-events:none;
  transition: all 1s;
  z-index: 1000;
}
#IrVentanaFlotante:target{
  opacity:1;
  pointer-events:auto;
}
</style>


    <?php if(@$nombre_user_sesion > 0):?>
    <div class="user" data-toggle="dropdown" role="button">
    <a class="nav-item nav-link active">BIENVENIDO: <?php echo @$nombre_user_sesion; ?></a></div>                        
    <?php endif;?>
<!--menu de salir-->                        
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
<a class="nav-link"  href="{{route('productos')}}'; ?>">Cerrar sesión</a>
</div>

<!--Buscar en el buscador-->

    <!-- Buscador -->
    <form class="form" method="post">
        <input class="input" id="productoBuscado" placeholder="Buscar" oninput="buscarProducto()">
        <button onclick="return false" class="button"><i class="fa fa-fw fa-search text-dark mr-2"></i></button>         
    </form>
<!--Buscar en el buscador-->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function buscarProducto() {
            var input, filter, productos, producto, i, txtValue;
            input = document.getElementById('productoBuscado');
            filter = input.value.toUpperCase();
            productos = document.getElementById('productos');
            producto = productos.getElementsByClassName('producto');

            for (i = 0; i < producto.length; i++) {
                txtValue = producto[i].textContent || producto[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
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
        document.getElementById('cantidad-productos').innerText = cantidadProductos;
}

function compra(){

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