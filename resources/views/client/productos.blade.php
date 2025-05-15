<!-- Start Banner Hero -->
<!DOCTYPE html>
<html lang="en">


@include('client.partials.header')



<!-- Start Banner Hero -->
<div id="" class="carousel slide" data-bs-ride="false">

    <div class="carousel-inner">
        <div class=" ">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 ">
                        <img class="img-fluid imagenprincipal" src="img/image_1.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Zay</b> Shop</h1>
                            <h3 class="h2">ROPA
                                DEPORTIVA</h3>
                            <p>
                                Encuentra las mejores prendas deportivas para hombre y mujer
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto ">
                <h1 class="h1">Categorias</h1>
                <p>

                </p>
            </div>
        </div>
        <div id="productos">
            <div class="row">

                <div class="col-12 col-md-4 p-5 mt-3">
                    <div class="producto" id="producto1">
                        <div class="item mb-4 text-center">
                            <a href="#"><img src="img/zapatos.png" class="item-image rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3 item-title">Zapatos</h5>
                            <div class="text-center item-details ">
                                <h4 class="btn btn-success item-price">$54000</h4>
                                <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 p-5 mt-3">
                    <div class="producto" id="producto1">
                        <div class="item mb-4 text-center">
                            <a href="#"><img src="img/gorra.png" class="item-image rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3 item-title">gorra</h5>
                            <div class="text-center item-details ">
                                <h4 class="btn btn-success item-price">$43000</h4>
                                <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 p-5 mt-3">
                    <div class="producto" id="producto1">
                        <div class="item mb-4 text-center">
                            <a href="#"><img src="img/camibuso.png" class="item-image rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3 item-title">camibuso</h5>
                            <div class="text-center item-details ">
                                <h4 class="btn btn-success item-price">$54000</h4>
                                <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 p-5 mt-3">
                    <div class="producto" id="producto1">
                        <div class="item mb-4 text-center">
                            <a href="#"><img src="img/busorosa.png" class="item-image rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3 item-title">buso pink</h5>
                            <div class="text-center item-details ">
                                <h4 class="btn btn-success item-price">$34000</h4>
                                <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 p-5 mt-3">
                    <div class="producto" id="producto1">
                        <div class="item mb-4 text-center">
                            <a href="#"><img src="img/busonegro.png" class="item-image rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3 item-title">buso dark</h5>
                            <div class="text-center item-details ">
                                <h4 class="btn btn-success item-price">$13000</h4>
                                <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 p-5 mt-3">
                    <div class="producto" id="producto1">
                        <div class="item mb-4 text-center">
                            <a href="#"><img src="img/busoamarillo.png" class="item-image rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3 item-title">buso yellow</h5>
                            <div class="text-center item-details ">
                                <h4 class="btn btn-success item-price">$14000</h4>
                                <button onclick="producto()" class="buttonshop addToCart"><img src="img/Shopping_cart_black.svg" alt="Descripción del icono"></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('client.partials.footer')


    </body>

</html>