<!-- editar_usuario.php -->
<?php
require_once './controller/UserController.php';
require_once './models/UserModel.php';

// Check if user ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Create an instance of UserController
    $userController = new UserController(new UserModel());

    try {
        // Get user details by ID
        $userDetails = $userController->getUserDetails($userId);
    } catch (Exception $e) {
        die("Error al obtener detalles del usuario: " . $e->getMessage());
    }

    // Check if user details are fetched successfully
    if (!$userDetails) {
        // Redirect to the user list page if user not found
        header('Location: actualizar_usuario.php');
        exit();
    }
} else {
    // Redirect to the user list page if no user ID is provided
    header('Location: actualizar_usuario.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Editar Usuario</h2>

        <!-- Form to edit user details -->
        <form method="post" action="actualizar_usuario.php">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">

            <!-- Fields for user details -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $userDetails['nombre']; ?>"
                    >
            </div>

            <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                <input type="text" name="apellido_paterno" class="form-control"
                    value="<?php echo $userDetails['apellido_paterno']; ?>" >
            </div>

            <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido Materno:</label>
                <input type="text" name="apellido_materno" class="form-control"
                    value="<?php echo $userDetails['apellido_materno']; ?>" >
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo $userDetails['telefono']; ?>"
                    >
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" name="correo" class="form-control" value="<?php echo $userDetails['correo']; ?>"
                    >
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" name="contrasena" class="form-control">
            </div>

            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>