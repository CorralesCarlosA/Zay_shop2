<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'zay_shop';
$username = 'root'; // Cambia esto si tu servidor usa otro usuario
$password_db = ''; // Cambia esto si tu servidor tiene contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    // Intentar encontrar al usuario en la tabla de administradores
    $stmt = $pdo->prepare("SELECT id_administrador, correoE, password FROM administradores WHERE correoE = ?");
    $stmt->execute([$correo]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($contrasena, $admin['password'])) {
        session_start();
        $_SESSION['tipo_usuario'] = 'administrador';
        $_SESSION['id_usuario'] = $admin['id_administrador'];
        echo "¡Bienvenido Administrador!";
        // Redirigir a panel de admin
        // header("Location: dashboard_admin.php");
        exit;
    }

    // Si no es administrador, buscar en clientes
    $stmt = $pdo->prepare("SELECT n_identificacion, correoE, password FROM clientes WHERE correoE = ?");
    $stmt->execute([$correo]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente && password_verify($contrasena, $cliente['password'])) {
        session_start();
        $_SESSION['tipo_usuario'] = 'cliente';
        $_SESSION['n_identificacion'] = $cliente['n_identificacion'];
        echo "¡Bienvenido Cliente!";
        // Redirigir a panel del cliente
        // header("Location: dashboard_cliente.php");
        exit;
    }

    // Si no se encontró en ninguna tabla
    echo "Correo o contraseña incorrectos.";
}