<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Obtén el nombre del usuario desde tu controlador de usuarios
// Esto es solo un ejemplo, asegúrate de ajustarlo según tu lógica real
require_once 'controller/UserController.php';
$userController = new UserController();
$user = $userController->getUserById($_SESSION['user_id']);

// Verifica si se encontró el usuario
if ($user) {
    $userName = $user['nombre']; // Ajusta el campo según tu base de datos
} else {
    // Manejo de error si no se encuentra el usuario
    $userName = 'Usuario Desconocido';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $userName; ?> </h1>

    <!-- Otro contenido de la página -->

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
