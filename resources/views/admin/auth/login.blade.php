<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Administrador</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    :root {
        --verde-oscuro: #1e5631;
        --verde-claro: #4c9c4c;
        --dorado: #d4af37;
        --blanco: #ffffff;
        --negro: #212529;
        --gris: #6c757d;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)),
            url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--negro);
    }

    .login-container {
        max-width: 500px;
        width: 100%;
        animation: fadeIn 0.8s ease-out;
    }

    .login-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        background-color: var(--blanco);
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: linear-gradient(135deg, var(--verde-oscuro), var(--verde-claro));
        padding: 2rem;
        text-align: center;
        border-bottom: 3px solid var(--dorado);
    }

    .card-title {
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--blanco);
    }

    .card-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 300;
    }

    .card-body {
        padding: 2.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--negro);
        margin-bottom: 0.5rem;
    }

    .form-control {
        height: 50px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        padding-left: 45px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--verde-oscuro);
        box-shadow: 0 0 0 0.25rem rgba(30, 86, 49, 0.25);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 70%;
        transform: translateY(-50%);
        color: var(--verde-oscuro);
        font-size: 1.2rem;
    }

    .btn-login {
        background: linear-gradient(135deg, var(--verde-oscuro), var(--verde-claro));
        border: none;
        height: 50px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        color: var(--dorado);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 86, 49, 0.3);
        color: var(--blanco);
    }

    .alert {
        border-left: 4px solid transparent;
        padding: 1rem;
    }

    .alert-danger {
        border-left-color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--gris);
    }

    .toggle-password:hover {
        color: var(--verde-oscuro);
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

    .decoration {
        position: absolute;
        opacity: 0.1;
        z-index: 0;
        color: var(--verde-oscuro);
    }

    .decoration-1 {
        top: 20%;
        left: 10%;
        font-size: 5rem;
    }

    .decoration-2 {
        bottom: 15%;
        right: 10%;
        font-size: 5rem;
    }
    </style>
</head>

<body>
    <!-- Elementos decorativos -->
    <i class="bi bi-trophy decoration decoration-1"></i>
    <i class="bi bi-shield decoration decoration-2"></i>

    <!-- Contenedor principal -->
    <div class="container login-container">
        <div class="login-card">
            <!-- Encabezado -->
            <div class="card-header">
                <h3 class="card-title mb-1">
                    <i class="bi bi-shield-lock me-2"></i>PANEL ADMINISTRATIVO
                </h3>
                <p class="card-subtitle mb-0">Acceso exclusivo para administradores</p>
            </div>

            <!-- Cuerpo del formulario -->
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf

                    <!-- Campo Email -->
                    <div class="mb-4 position-relative">
                        <label for="correoE" class="form-label">Correo Electrónico</label>
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email" name="correoE" id="correoE" class="form-control" required autofocus>
                        @error('correoE')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="mb-4 position-relative">
                        <label for="password" class="form-label">Contraseña</label>
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="toggle-password">
                            <i class="bi bi-eye-fill" id="toggleIcon"></i>
                        </span>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i> INICIAR SESIÓN
                        </button>
                    </div>
                </form>
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
    });
    </script>
</body>

</html>