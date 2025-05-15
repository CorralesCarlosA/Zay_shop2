 <!-- Start Banner Hero -->
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
                         <img class="img-fluid" src="./frontend/img/banner_img_01.jpg" alt="">
                     </div>
                     <div class="col-lg-6 mb-0 d-flex align-items-center">
                         <div class="text-align-left align-self-center">
                             <h1 class="h1 text-success"><b>Zay</b> Shop</h1>
                             <h3 class="h2">Zapato white black</h3>
                             <p>
                                 Los zapatos blancos son un tipo de calzado que se caracteriza por su color blanco en su mayoría. Son populares en diversas ocasiones, como bodas, eventos formales, deportes, y también en el ámbito de la moda casual.
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="carousel-item">
             <div class="container">
                 <div class="row p-5">
                     <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                         <img class="img-fluid" src="./frontend/img/banner_img_02.jpg" alt="">
                     </div>
                     <div class="col-lg-6 mb-0 d-flex align-items-center">
                         <div class="text-align-left">
                             <h1 class="h1">Desodorante Curologyt</h1>
                             <p>
                                 Curology es una marca de cuidado de la piel que ofrece productos personalizados para el cuidado de la piel.
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="carousel-item">
             <div class="container">
                 <div class="row p-5">
                     <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                         <img class="img-fluid" src="./frontend/img/banner_img_03.jpg" alt="">
                     </div>
                     <div class="col-lg-6 mb-0 d-flex align-items-center">
                         <div class="text-align-left">
                             <h1 class="h1">Lámpara</h1>
                             <p>
                                 Una lámpara es un dispositivo que genera luz mediante una fuente de iluminación, como una bombilla o una fuente de luz LED, y puede utilizarse para iluminar un espacio o como un elemento decorativo.
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
             <i class="fas fa-chevron-left"></i>
         </a>
         <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
             <i class="fas fa-chevron-right"></i>
         </a>
     </div>
     <!-- End Banner Hero -->

     <!-- Start Categories of The Month -->
     <section class="container py-5">
         <div class="row text-center pt-3">
             <div class="col-lg-6 m-auto">
                 <h1 class="h1">Productos Nuevos</h1>
                 <p>

                 </p>
             </div>
         </div>
         <div id="productos"> <!--Buscar en el buscador-->
             <div class="row">
                 <?php if (isset($product)) : ?>
                     <?php foreach ($product as $columna) : ?>

                         <div class="col-12 col-md-4 p-5 mt-3">
                             <div class="producto" id="producto1"><!--Buscar en el buscador-->
                                 <div class="item mb-4">
                                     <a><img style="height:150px" src=" . 'frontend/archivos/producto/producto_' . $columna->Id . '.jpg'; ?>" class="item-image rounded-circle img-fluid border"></a>
                                     <h5 class="text-center mt-3 mb-3 item-title"><?php echo $columna->NombreProducto; ?></h5>
                                     <p class="text-center item-details">
                                     <h4 class="item-price">$<?php echo $columna->PrecioProducto; ?></h4>
                                     <button onclick="producto()" class="btn btn-success addToCart">Añadir al carrito</button></p>
                                 </div>
                             </div>
                         </div>
                     <?php endforeach;  ?>
                 <?php endif; ?>
             </div>
         </div>

     </section>
     <!-- End Categories of The Month -->