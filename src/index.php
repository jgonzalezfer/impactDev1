<?php
// Incluye los archivos necesarios
require_once 'config/database.php';
require_once 'controller/AuthController.php';

// Verifica si se envió el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Obtén las credenciales del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Crea una instancia del controlador de autenticación
    $authController = new AuthController();

    // Intenta autenticar al usuario
    $result = $authController->authenticate($email, $password);

    // Verifica el resultado de la autenticación
    if ($result['success']) {
        // Inicio de sesión exitoso, redirige a la página principal o realiza otras acciones necesarias
        header('Location: home.php');
        exit;
    } else {
        // Error en la autenticación, muestra un mensaje de error
        $error = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required>

        <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <br>

        <button type="submit" name="login">Iniciar sesión</button>
    </form>
</body>
</html>
