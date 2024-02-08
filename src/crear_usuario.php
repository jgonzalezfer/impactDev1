<?php
require_once './controller/UserController.php';
require_once './models/UserModel.php';
require_once './utils/Validator.php';

$userController = new UserController(new UserModel());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'nombre' => $_POST['nombre'],
        'apellido_paterno' => $_POST['apellido_paterno'],
        'apellido_materno' => $_POST['apellido_materno'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'],
        'contrasena' => $_POST['contrasena']
    ];

    $validador = new Validador();
    $resultValidacion = $validador->validarCorreoExistente($userData['correo']);

    if (isset($resultValidacion['error'])) {
        echo '<div class="alert alert-danger" role="alert">' . $resultValidacion['error'] . '</div>';
    } else {
        $result = $userController->createUser($userData);

        if (isset($result['success'])) {
            echo '<div class="alert alert-success" role="alert">' . $result['success'] . '</div>';
            echo '<a href="home.php" class="btn btn-primary">Ir al Home</a>';
        } elseif (isset($result['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $result['error'] . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Crear Usuario</h2>

        <!-- Formulario para crear un nuevo usuario -->
        <form method="post" action="crear_usuario.php">
            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                <input type="text" name="apellido_paterno" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido Materno:</label>
                <input type="text" name="apellido_materno" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono: +56 9</label>
                <input type="text" name="telefono" class="form-control" placeholder="9 8299 6030"
                    pattern="[9]{1}[0-9]{8}" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>