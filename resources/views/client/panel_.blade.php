<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel de administración</title>

    <!--Favicon-->
    <link rel="shortcut icon"  href="frontend/img/favicon.ico">

    <!-- Custom fonts for this template-->
    <link href="frontend/plantilla/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="frontend/plantilla/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="frontend/css/icomoon/style.css">
     <link rel="stylesheet" href="frontend/css/bootstrap_icon.css">
    <link rel="stylesheet" href="frontend/css/estilo0.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="panel-control">
                <div class="sidebar-brand-text mx-3">SOY<sup> Admin</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="administrador">
                    
                    <span>Panel de productos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Opciones
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link"  href="productosad">
                    
                    <span>Administrar productos</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="listar">
                    
                    <span>Administar Clientes</span></a>
            </li>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img style="height: 150px;" src="https://png.pngtree.com/png-vector/20190301/ourlarge/pngtree-vector-administration-icon-png-image_747092.jpg" alt="...">
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <h1>Panel de administración</h1>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                         <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "Bienvenido: Admin" ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="sesion" data-toggle="modal" data-target="#logoutModal">
                                    <i class="icon-cross"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h1 class="h2 mb-0 text-gray-800">Escritorio</h1>
                        
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Módulos de administración</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">

                        <style type="text/css">p{color: black;}</style>

                        <div class="container my-5 py-2">

                            <div id="divModules" class="row">
                                <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center aos-init aos-animate">
                                    <i class="fas fa-solar-panel moduleIcon" aria-hidden="true"></i>
                                    <h4>Panel de control</h4>
                                    <p>Configuración de la tienda.</p>
                                </div>

                                <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center aos-init aos-animate">
                                    <i class="fas fa-users moduleIcon" aria-hidden="true"></i>
                                    <h4>Usuarios</h4>
                                    <p>1 rol, acceso al sistema de acuerdo con el rol.</p>
                                </div>

                               <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center aos-init aos-animate">
                                   <i class="fas fa-user moduleIcon" aria-hidden="true"></i>
                                   <h4>Clientes</h4>
                                   <p>Administra tus clientes fácil y rápido.</p>
                               </div>

                               <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center aos-init aos-animate">
                                   <i class="fas fa-store-alt moduleIcon" aria-hidden="true"></i>
                                   <h4>Inicio</h4>
                                   <p>Al salir vuelve a la pagina principal.</p>
                               </div>

                               <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center aos-init aos-animate">
                                   <i class="fas fa-box moduleIcon" aria-hidden="true"></i>
                                   <h4>Productos</h4>
                                   <p>Control de productos en existencia.</p>
                               </div>

                               <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true" class="col-md-4 text-center aos-init aos-animate">
                                   <i class="fas fa-shopping-cart moduleIcon" aria-hidden="true"></i>
                                   <h4>Ventas</h4>
                                   <p>Information de ventas.</p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div></div>
           </div>
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ventas</h6>

                                </div>

                                  <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> 
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> 
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccionar el boton "Salir" de abajo, si usted está listo para finalizar la sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{route('productos')}}">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="frontend/plantilla/vendor/jquery/jquery.min.js"></script>
    <script src="frontend/plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Page level plugins -->
    <script src="frontend/plantilla/vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="frontend/plantilla/js/demo/chart-area-demo.js"></script>
    <script src="frontend/plantilla/js/demo/chart-pie-demo.js"></script>


</body>

</html>