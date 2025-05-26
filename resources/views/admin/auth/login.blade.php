<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo | Liga Deportiva</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts - Montserrat para estilo deportivo -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --primary-color: #1a3e2a;
        /* Verde oscuro para opciones importantes */
        --secondary-color: #d4af37;
        /* Dorado para acentos */
        --light-bg: #ffffff;
        /* Fondo blanco */
        --text-dark: #000000;
        /* Texto negro para contenido no relevante */
        --text-light: #f8f9fa;
        /* Texto claro para contrastes */
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: var(--light-bg);
        min-height: 100vh;
        display: flex;
        align-items: center;
        color: var(--text-dark);
        background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.85);
        z-index: 0;
    }

    .login-container {
        animation: fadeIn 0.8s ease-out;
        position: relative;
        z-index: 1;
    }

    .card-login {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        background-color: var(--light-bg);
    }

    .card-login:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), #2a5c3a);
        padding: 2.5rem 1rem;
        position: relative;
        overflow: hidden;
        border-bottom: 3px solid var(--secondary-color);
    }

    .logo-container {
        width: 80px;
        height: 80px;
        background-color: var(--light-bg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 2px solid var(--secondary-color);
    }

    .logo-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
    }

    .form-control {
        height: 50px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        padding-left: 45px;
        color: var(--text-dark);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(26, 62, 42, 0.25);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .btn-login {
        background-color: var(--primary-color);
        border: none;
        height: 50px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: #2a5c3a;
        transform: translateY(-2px);
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--secondary-color);
    }

    .sport-decoration {
        position: absolute;
        opacity: 0.1;
        z-index: 0;
        color: var(--primary-color);
    }

    .text-accent {
        color: var(--secondary-color) !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .floating-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        animation: slideIn 0.5s ease-out;
        border-left: 4px solid var(--secondary-color);
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .footer-text {
        color: var(--secondary-color);
    }

    .text-muted {
        color: var(--text-dark) !important;
        opacity: 0.7;
    }
    </style>
</head>

<body>
    <!-- Elementos decorativos deportivos -->
    <i class="bi bi-trophy-fill sport-decoration" style="top: 20%; left: 10%; font-size: 5rem;"></i>
    <i class="bi bi-journal-medical sport-decoration" style="bottom: 15%; right: 10%; font-size: 5rem;"></i>

    <!-- Contenedor principal -->
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <!-- Tarjeta de login -->
                <div class="card card-login">
                    <!-- Encabezado con logo -->
                    <div class="card-header text-center text-white">
                        <div class="logo-container">
                            <i class="bi bi-shield-lock logo-icon"></i>
                        </div>
                        <h2 class="fw-bold mb-1">ADMINISTRACIÓN ZAY SHOP</h2>
                        <p class="mb-0 text-accent">Acceso exclusivo</p>
                    </div>

                    <!-- Cuerpo del formulario -->
                    <div class="card-body p-4 p-md-5">
                        <!-- Mensaje de error (si existe) -->
                        @if(session('error'))
                        <div class="floating-alert alert alert-dark alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill text-accent me-2"></i>
                            <span class="text-dark">{{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Formulario de login -->
                        <form method="POST" action="{{ route('admin.login') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Campo Email -->
                            <div class="mb-4 position-relative">
                                <label for="correoE" class="form-label fw-bold">Correo Administrativo</label>
                                <i class="bi bi-envelope-at-fill input-icon"></i>
                                <input type="email" name="correoE" id="correoE" class="form-control ps-4"
                                    placeholder="admin@deportes.com" required>
                                <div class="invalid-feedback text-dark">
                                    Por favor ingresa un correo válido
                                </div>
                            </div>

                            <!-- Campo Contraseña -->
                            <div class="mb-4 position-relative">
                                <label for="password" class="form-label fw-bold">Contraseña</label>
                                <i class="bi bi-lock-fill input-icon"></i>
                                <input type="password" name="password" id="password" class="form-control ps-4" required>
                                <span class="toggle-password">
                                    <i class="bi bi-eye-fill" id="toggleIcon"></i>
                                </span>
                                <div class="invalid-feedback text-dark">
                                    Por favor ingresa tu contraseña
                                </div>
                            </div>

                            <!-- Botón de submit -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-login text-light py-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> INICIAR SESIÓN
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Pie de tarjeta -->
                    <div class="card-footer text-center py-3 bg-light">
                        <small class="footer-text">
                            <i class="bi bi-shield-check me-1"></i> Sistema seguro - Todos los derechos reservados
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Mostrar/ocultar contraseña
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Cambiar icono
            if (type === 'password') {
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            } else {
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            }
        });

        // Validación de formulario
        (function() {
            'use strict';

            // Obtener todos los formularios que necesitan validación
            var forms = document.querySelectorAll('.needs-validation');

            // Loop sobre ellos y prevenir el envío
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
        })();

        // Cerrar alerta automáticamente después de 5 segundos
        const alert = document.querySelector('.floating-alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 150);
            }, 5000);
        }
    });
    </script>
</body>

</html>