<?php

$user = session('user');

?>
<!DOCTYPE html>
<html lang="en">


@include('client.partials.header')


<section class="">
    <div style="display: block;"
        class=" d-flex justify-content-center align-items-center gallery text-center container-fluid gallery-item justify-content-center">

        <div id="login" class="container">
            <div class="row d-flex justify-content-center">
                <!--nuevo-->
                <div class="container2">
                    <!--nuevo-->
                    <div class="image-section">
                        <img src="img/hermes.png" alt="HERMES">
                    </div>
                    <div class="form-section">
                        <div class=" border-3 border-primary"></div>
                        <div class="card bg-white shadow-lg">
                            <div class="card-body p-5">
                                <form class="mb-3 mt-md-4" method="post" action="{{url('verificar')}}">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase">Inicia sección</h2>
                                    <p class="mb-5">Por favor introduzca su Email y contraseña!</p>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control imputs" id="email"
                                            placeholder="name@example.com" required name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control imputs" id="password"
                                            placeholder="*******" required name="password">
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-outline-primary" type="submit">Iniciar sección</button>
                                    </div>
                                </form>
                                <div>
                                    <p class="mb-0 text-center">¿No tienes cuenta? <button
                                            class="btn btn-outline-primary" onclick="showRegister()">Registrate
                                        </button></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div style="display: none;" id="registro"
        class="gallery text-center container-fluid gallery-item justify-content-center ">
        <div class=" d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <!--desde aqui-->

                    <div class="container2">
                        <div class="image-section">
                            <img src="img/hermes.png" alt="HERMES">
                        </div>

                        <div class="form-section">
                            <div class="card bg-white shadow-lg">
                                <div class="card-body p-5">
                                    <form class="mb-3 mt-md-4" method="post" action="{{url('inicio_de_sesion')}}">
                                        @csrf
                                        <h2 class="fw-bold mb-2 text-uppercase">Regístrate</h2>
                                        <div class="mb-3">
                                            <label for="fullName">Nombre completo</label>
                                            <input type="text" id="fullName" class="form-control imputs"
                                                placeholder="Nombre" required name="nombre">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control imputs" id="email"
                                                placeholder="name@example.com" required name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control imputs" id="password"
                                                placeholder="*******" required name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Número de teléfono</label>
                                            <input type="tel" class="form-control imputs" id="phone" required
                                                name="telefono">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Dirección</label>
                                            <input type="text" class="form-control imputs" id="address" required
                                                name="direccion">
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary" type="submit">Crear cuenta</button>
                                        </div>
                                    </form>
                                    <div>
                                        <p class="mb-0 text-center">¿Ya tienes una cuenta? <button
                                                class="btn btn-outline-primary" onclick="showLogin()">Inicia sección
                                            </button></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
function showRegister() {
    document.getElementById('login').style.display = 'none';
    document.getElementById('registro').style.display = 'block';
}


function showLogin() {
    document.getElementById('registro').style.display = 'none';
    document.getElementById('login').style.display = 'block';
}
</script>

<!-- Start Categories of The Month 
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">INICIAR SESION</h1>
                <p>

                </p>
            </div>
        </div>


        <!Login Start 
        <div>
            <center>

                <form id="contactForm" action="#" method="POST" style="width: 250px;">
                    @csrf

                    <div class="row g-3">

                        <center>
                            <img style="width: 100px; height: 100px;" src="<?php #echo '.\frontend\img/favicon.png'; ?>">
                        </center>

                        <input class="form-control bg-transparent" type="email" id="correo" name="gmail"
                            placeholder="Correo Electrónico" autocomplete="off" required>
                        <br>

                        <input class="form-control bg-transparent" id="pwd" type="password" name="pwd" minlength="4"
                            maxlength="8" placeholder="Contraseña" required>

                        <div>
                            <button class="btn btn-primary w-100 py-3" onclick="location.href=''">Ingresar</button>
                        </div>

                        <p class="text-center">¿No tiene una cuenta? <a type="button" href="registro"
                                class="breadcrumb-item text-primary active">Cree Una Aqui</a>
                        </p>

                    </div>

                    <?php #if (isset($_SESSION['error_session'])) : ?>
                    <center>
                        <h6>Contraseña o usuario ingresados de manera incorrecta. Vuelva a intentarlo</h6>
                    </center>
                    <?php # endif; ?>

                </form>

        </div>
        </center>
    Login End 

    </section>-->


<!-- End Categories of The Month -->
@include('client.partials.footer')

<!-- Start Script -->
<script src="frontend/js/foto_move.js"></script>
<!-- End Script -->

</body>

</html>